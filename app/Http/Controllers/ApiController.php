<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use \App\Thread as Thread;
use \App\UpdateRecord as UpdateRecord;
use \App\Post as Post;
use Response;
use Request;
use DB;
use Cache;
use \ImageUpload\Services\Imgur as Imgur;
use \ImageUpload\Services\ImageShack as Imageshack;

class ApiController extends BaseController
{
	public function latestThreads($page, $board)
	{
		$count = Thread::count();
		$threads = Thread::skip((($page - 1) * 15))->take(15)->orderBy('id', 'desc');

		if ($board != 'all') {
			$threads->where('board', '=', $board);
		}

		return response()->json([
			'total_rows' => $count,
			'threads' => $threads->get()
		]);
	}

	public function popularThreads($page, $board)
	{
		$count = Thread::count();
		$threads = Thread::orderBy(DB::raw("((30 - (DATEDIFF(NOW(), created_at))) / 30 * views)"), "DESC")->take(15);

		if ($board != 'all') {
			$threads->where('board', '=', $board);
		}

		$result = [];
		foreach($threads->get() as $thread) {
			$threadArray = $thread->toArray();
			$threadArray['post'] = $thread->posts()->take(1)->get()->toArray();

			$result[] = $threadArray;
		}

		return response()->json([
			'total_rows' => $count,
			'threads' => $result
		]);
	}

	public function statistics()
	{
		$thread = Thread::select(DB::raw("count(id) as thread_count, sum(views) as views_count"))->first();
		$posts = Post::select(DB::raw("count(id) as posts_count, count(image_url) as image_count"))->first();

		return response()->json(['stats' => [
			'thread_count' => $thread->thread_count,
			'views_count' => $thread->views_count,
			'posts_count' => $posts->posts_count,
			'image_count' => $posts->image_count
		]]);
	}

	public function archive()
	{
		$board = Request::input('board');
		$thread_id = Request::input('thread_id');

		// Validation
		if (!$board || !is_numeric($thread_id)) {
			return response()->json(['error' => 'no board or thread_id']);
		}

		// Is this board blacklisted?
		if (in_array($board, ['gif'])) {
			return response()->json(['error' => 'This board is currently not allowed to be archived.']);
		}

		// Retrieve thread JSON and validate
		$threadJson = @file_get_contents('http://a.4cdn.org/' . $board . '/thread/' . $thread_id . '.json');

		if (!$threadJson) {
			return response()->json(['error' => 'Thread not found. Did it 404?']);
		}

		$threadInformation = json_decode($threadJson);

		if (!$threadInformation) {
			return response()->json(['error' => 'Something went wrong here... Unable to parse response from 4chan']);
		}

		$livePosts = $threadInformation->posts;
		$livePostCount = count($livePosts);

		// Does this thread have more than 10 replies?
		if ($livePostCount <= 10) {
			return response()->json(['error' => 'To archive a thread, it must have at least 10 replies.']);
		}

		// Has this thread been archived in the past?
		$threadCheck = Thread::withTrashed()
			->where('board', '=', $board)
			->where('thread_id', '=', $thread_id);

		$postPosition = 0; // Default value (start from beginning of thread

		if ($threadCheck->count() > 0) {
			$existingThread = $threadCheck->first();

			// Has this thread been taken down?
			if ($existingThread->deleted_at != null) {
				return response()->json(['error' => 'This thread is not allowed to be archived.']);
			}

			// Is this thread currently busy?
			if ($existingThread->busy) {
				return response()->json(['error' => 'This thread is currently in the process of being archived by someone else.']);
			}

			// Retrieve posts for this thread.
			// Determine at what point we should continue archiving this thread.
			$existingPosts = $existingThread->posts()->withTrashed();
			$existingPostCount = $existingPosts->count();

			// No existing posts? Huh...
			if ($existingPostCount == 0) {
				return response()->json(['error' => 'Something weird happened... Please try again later.']);
			}

			$lastExistingPost = $existingPosts->get()->last();

			// Get last live post (from 4chan API) and compare with the last post
			// we recorded since last archive attempt.
			$lastLivePost = end($livePosts);

			if ($lastExistingPost->chan_id == $lastLivePost->no) {
				return response()->json(['success' => true]);
			}

			// Wait... what? This shouldn't happen.
			if ($existingPostCount > $livePostCount) {
				return repsonse()->json(['error' => 'Something weird happened... Please try again later.']);
			}

			// Update existing thread to become busy.
			$existingThread->busy = 1;
			$existingThread->updated_num++;
			$existingThread->save();

			// Set post position to existingPostCount.
			$postPosition = $postPosition;
		} else {
			// Create a new thread
			$existingThread = new Thread();
			$existingThread->board = $board;
			$existingThread->thread_id = $thread_id;
			$existingThread->busy = 1;
			$existingThread->secret = str_random(8);
			$existingThread->save();
		}

		// Add user IP to list of user IPs
		$update_record = new UpdateRecord();
		$update_record->thread_id = $existingThread->id;
		$update_record->user_ip = Request::ip();
		$update_record->save();

		$postsToInsert = [];
		// Start recording posts, starting at last reply position
		for ($i = $postPosition; $i < $livePostCount; $i++) { 
			$livePost = $livePosts[$i];

			$postID = isset($livePost->no) ? $livePost->no : null;
			$subject = isset($livePost->sub) ? $livePost->sub : null;
			$name = isset($livePost->name) ? $livePost->name : "";
			$posterId = isset($livePost->id) ? $livePost->id : null;
			$tripcode = isset($livePost->trip) ? $livePost->trip : null;
			$capcode = isset($livePost->capcode) ? $livePost->capcode : null;
			$postTimestamp = isset($livePost->time) && is_numeric($livePost->time) ? $livePost->time : null;
			$postBody = isset($livePost->com) ? $livePost->com : "";

			// Set image default values
			$imageName = null;
			$imageSize = 0;
			$thumbWidth = 0;
			$thumbHeight = 0;
			$imageWidth = 0;
			$imageHeight = 0;
			$imageUrl = null;
			$originalImageName = null;
			$imageDeleteHash = null;
			$chanImageName = null;


			// Do we have an image with this post? "tim" is only set when there is an image.
			if (isset($livePost->tim) && $livePost->tim > 0) {
				$chanImageName = $livePost->tim . $livePost->ext;

				$imageLink = "http://i.4cdn.org/" . $board . "/src/" . $chanImageName;
				$thumbWidth = $livePost->tn_w;
				$thumbHeight = $livePost->tn_h;
				$imageWidth = $livePost->w;
				$imageHeight = $livePost->h;
				$originalImageName = $livePost->filename . $livePost->ext;
				$imageSize = $livePost->fsize;

				$deleteHash = "";
				$uploadedImage = "/image/image-404.png";

				// Upload to Imgur or Imageshack
				$imgur = new Imgur(env('IMGUR_KEY'));
				$response = json_decode($imgur->upload($imageLink));
				if($response && isset($response->status) && $response->status == 200) {
					$uploadedImage = $response->data->link;
					$deleteHash = $response->data->deletehash;
				} else {
					// Imgur failed, upload to Imageshack
					$imageshack = new Imageshack(env('IMAGESHACK_KEY'));
					$response = $imageshack->upload($imageLink);
					if ($response && isset($response->status) && $response->status == 1) {
						$uploadedImage = $response->links->image_link;
					}
				}
			}

			$postsToInsert[] = [
				"chan_id" => $postID,
				"thread_id" => $existingThread->id,
				"original_image_name" => $originalImageName,
				"image_size" => $imageSize,
				"image_width" => $imageWidth,
				"image_height" => $imageHeight,
				"thumb_width" => $thumbWidth,
				"thumb_height" => $thumbHeight,
				"image_url" => $uploadedImage,
				"imgur_hash" => $deleteHash,
				"subject" => $subject,
				"name" => $name,
				"tripcode" => $tripcode,
				"capcode" => $capcode,
				"post_timestamp" => DB::raw('FROM_UNIXTIME(' . $postTimestamp . ')'), // $postTimestamp is verified to be a numeric value above.
				"body" => $postBody,
				"updated_at" => DB::raw('NOW()'), // Because we're using mass-insertion, we have to set these ourselves :(
				"created_at" => DB::raw('NOW()')
			];
		}

		Post::insert($postsToInsert); // Mass insert posts
	
		$existingThread->busy = 0;
		$existingThread->save();

		if (Cache::has('thread_' . $board . '_' . $thread_id)) {
			Cache::forget('thread_' . $board . '_' . $thread_id);			
		}

		return response()->json(['success' => true]);
	}
}