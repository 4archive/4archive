<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('chan_id');
			$table->integer('thread_id')->unsigned();
			
			$table->string('original_image_name', 255)->nullable();
			$table->integer('image_size')->default(0);
			$table->integer('image_width')->default(0);
			$table->integer('image_height')->default(0);
			$table->integer('thumb_width')->default(0);
			$table->integer('thumb_height')->default(0);
			$table->string('image_url', 255)->nullable();
			$table->string('imgur_hash', 50)->nullable(); // I don't remember how long these hashes are.

			$table->string('subject', 255)->nullable();
			$table->string('name', 255)->default('Anonymous');
			$table->string('tripcode', 50)->nullable();
			$table->string('capcode', 50)->nullable();
			$table->timestamp('post_timestamp');
			$table->text('body');

			$table->softDeletes();
			$table->timestamps();

			$table->foreign('thread_id')->references('id')->on('threads');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
