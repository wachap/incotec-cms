<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');
			$table->string('instructor');
			$table->string('image_url');
			$table->string('address');	//duracion
			$table->enum('course_level', ['profesional', 'tecnico', 'curso']);
			$table->text('body');
			$table->string('slug');
			$table->boolean('available');
			
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
		Schema::drop('courses');
	}

}
