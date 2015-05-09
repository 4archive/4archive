<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('threads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('thread_id');
			$table->string('board', 10);
			$table->tinyInteger('busy')->default(0);
			$table->integer('updated_num')->default(0);
			$table->integer('views')->default(0);
			$table->string('notice', 255)->nullable();
			$table->string('secret', 8);
			$table->string('takedown_reason', 255)->nullable();
			$table->timestamp('tweeted_at');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('threads');
	}

}
