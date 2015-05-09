<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTakedownRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('takedown_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('thread_id')->unsigned();
			$table->string('reason', 255);
			$table->text('info_provided');
			$table->tinyInteger('processed')->default(0);
			$table->tinyInteger('approved')->default(0);
			$table->string('user_ip', 50);
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
		Schema::drop('takedown_requests');
	}

}
