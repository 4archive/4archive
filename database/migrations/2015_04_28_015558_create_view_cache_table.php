<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewCacheTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('view_cache', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('thread_id')->unsigned();
			$table->string('user_ip', 255);
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
		Schema::drop('view_cache');
	}

}
