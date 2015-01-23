<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workes', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('full_name');
			$table->string('image_url');
			$table->enum('job_type', ['Director', 'Secretaria', 'Profesor']);
			$table->date('since');
			$table->text('body');
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
		Schema::drop('workes');
	}

}
