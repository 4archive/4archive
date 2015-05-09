<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Request;
use \App\Thread;
use \App\ViewCache;
use Cache;

class ThreadController extends BaseController
{
	public function view($board, $thread_id)
	{
		// Does the thread exist?
		$thread = Thread::withTrashed()->where("board", "=", $board)->where("thread_id", "=", $thread_id)->firstOrFail();
		
		// Has this thread been takendown? But does this user know the secret key?
		if ($thread->deleted_at != null && Request::input('sv') != $thread->secret) {
			return view('thread.takendown', ['reason' => ($thread->takedown_reason ? $thread->takedown_reason : "No reason given.")]);
		}

		// Fetch cache first.
		if (Cache::has('thread_' . $board . '_' . $thread_id)) {
			return Cache::get('thread_' . $board . '_' . $thread_id);
		}

		// No cache? Okay, let's fetch all the posts.
		$posts = $thread->posts()->get();

		// Has this user already viewed this thread in the past 12 hours?
		$viewCache = ViewCache::where('user_ip', '=', Request::ip())->first();
		if (!$viewCache) {
			// They haven't viewed this thread in the past 12 hours. Add to cache
			$viewCache = new ViewCache();
			$viewCache->thread_id = $thread->id;
			$viewCache->user_ip = Request::ip();
			$viewCache->save();
		}

		$op = $posts[0];
		unset($posts[0]); // remove OP. only leave replies.

		$response = view('thread.view', ['thread' => $thread, 'replies' => $posts, 'op' => $op])->render();
		Cache::put('thread_' . $board . '_' . $thread_id, $response, 60);

		return $response;
	}
}
