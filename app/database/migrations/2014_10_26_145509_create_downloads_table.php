<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDownloadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('downloads', function(Blueprint $table)
		{
			$table->increments('id');

			$table->enum('file_type', ['horario', 'modulos', 'material']);
			$table->string('description');
			$table->string('file_url');
			$table->integer('course_id')->unsigned();
			
			$table->foreign('course_id')->references('id')->on('courses');

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
		Schema::drop('downloads');
	}

}
