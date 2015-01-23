<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programmes', function(Blueprint $table) 
		{
			$table->increments('id');

			$table->string('title');
			$table->string('time');
			$table->integer('activity_id')->unsigned();
			
			$table->foreign('activity_id')->references('id')->on('activities');
			
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
		Schema::drop('programmes');
	}

}
