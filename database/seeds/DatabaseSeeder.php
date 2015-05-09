<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\Thread;
use \App\Post;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('ThreadSeeder');
	}

}

class ThreadSeeder extends Seeder
{
	public function run()
	{
		DB::table('update_records')->delete();
		DB::table('view_cache')->delete();
		DB::table('posts')->delete();
		DB::table('threads')->delete();

		##################

		Thread::create([
			'id' => 1,
			'thread_id' => 111111111,
			'board' => 'a',
			'updated_num' => 0,
			'views' => '500',
			'notice' => null,
			'secret' => 'a719c9a1',
			'takedown_reason' => null,
			'tweeted_at' => null
		]);

		Post::create([
			'chan_id' => 111111111,
			'thread_id' => 1,
			'original_image_name' => 'Imgur.jpg',
			'image_size' => 128000,
			'image_width' => '535',
			'image_height' => '535',
			'thumb_width' => '250',
			'thumb_height' => '250',
			'image_url' => 'http://i.imgur.com/UmmyTUG.png',
			'imgur_hash' => 'something',
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 111111112,
			'thread_id' => 1,
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 111111113,
			'thread_id' => 1,
			'original_image_name' => 'Imgur 2.jpg',
			'image_size' => 34000,
			'image_width' => '500',
			'image_height' => '466',
			'thumb_width' => '116',
			'thumb_height' => '125',
			'image_url' => 'http://i.imgur.com/w6pQEvY.jpg',
			'imgur_hash' => 'something',
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 111111114,
			'thread_id' => 1,
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		##################

		Thread::create([
			'id' => 2,
			'thread_id' => 222222222,
			'board' => 'b',
			'updated_num' => 0,
			'views' => '555',
			'notice' => null,
			'secret' => 'a719c9a1',
			'takedown_reason' => null,
			'tweeted_at' => null
		]);

		Post::create([
			'chan_id' => 222222222,
			'thread_id' => 2,
			'original_image_name' => 'Imgur.jpg',
			'image_size' => 128000,
			'image_width' => '535',
			'image_height' => '535',
			'thumb_width' => '250',
			'thumb_height' => '250',
			'image_url' => 'http://i.imgur.com/UmmyTUG.png',
			'imgur_hash' => 'something',
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 222222223,
			'thread_id' => 2,
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 222222224,
			'thread_id' => 2,
			'original_image_name' => 'Imgur 2.jpg',
			'image_size' => 34000,
			'image_width' => '500',
			'image_height' => '466',
			'thumb_width' => '116',
			'thumb_height' => '125',
			'image_url' => 'http://i.imgur.com/w6pQEvY.jpg',
			'imgur_hash' => 'something',
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 222222225,
			'thread_id' => 2,
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		##################

		Thread::create([
			'id' => 3,
			'thread_id' => 333333333,
			'board' => 'g',
			'updated_num' => 3,
			'views' => '123',
			'notice' => 'Admin note: This thread is garbage.',
			'secret' => 'a719c9a1',
			'takedown_reason' => null,
			'tweeted_at' => null
		]);

		Post::create([
			'chan_id' => 333333333,
			'thread_id' => 3,
			'original_image_name' => 'Imgur.jpg',
			'image_size' => 128000,
			'image_width' => '535',
			'image_height' => '535',
			'thumb_width' => '250',
			'thumb_height' => '250',
			'image_url' => 'http://i.imgur.com/UmmyTUG.png',
			'imgur_hash' => 'something',
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 333333334,
			'thread_id' => 3,
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 333333335,
			'thread_id' => 3,
			'original_image_name' => 'Imgur 2.jpg',
			'image_size' => 34000,
			'image_width' => '500',
			'image_height' => '466',
			'thumb_width' => '116',
			'thumb_height' => '125',
			'image_url' => 'http://i.imgur.com/w6pQEvY.jpg',
			'imgur_hash' => 'something',
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 333333336,
			'thread_id' => 3,
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		##################

		Thread::create([
			'id' => 4,
			'thread_id' => 444444444,
			'board' => 'q',
			'updated_num' => 10,
			'views' => '1250',
			'notice' => null,
			'secret' => 'a719c9a1',
			'takedown_reason' => null,
			'tweeted_at' => null,
			'deleted_at' => DB::raw('NOW()')
		]);

		Post::create([
			'chan_id' => 444444444,
			'thread_id' => 4,
			'original_image_name' => 'Imgur.jpg',
			'image_size' => 128000,
			'image_width' => '535',
			'image_height' => '535',
			'thumb_width' => '250',
			'thumb_height' => '250',
			'image_url' => 'http://i.imgur.com/UmmyTUG.png',
			'imgur_hash' => 'something',
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 444444445,
			'thread_id' => 4,
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 444444446,
			'thread_id' => 4,
			'original_image_name' => 'Imgur 2.jpg',
			'image_size' => 34000,
			'image_width' => '500',
			'image_height' => '466',
			'thumb_width' => '116',
			'thumb_height' => '125',
			'image_url' => 'http://i.imgur.com/w6pQEvY.jpg',
			'imgur_hash' => 'something',
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);

		Post::create([
			'chan_id' => 444444447,
			'thread_id' => 4,
			'subject' => null,
			'name' => 'Anonymous',
			'tripcode' => null,
			'capcode' => null,
			'post_timestamp' => DB::raw('FROM_UNIXTIME(1429902005)'),
			'body' => 'What is your movie editing software of choice? Pic related for me, but the things you can do it with are pretty limited. Is there a good (free) alternative for simple video editing?'
		]);
	}
}