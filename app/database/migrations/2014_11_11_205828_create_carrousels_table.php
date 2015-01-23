<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrouselsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carrousels', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('image_url');
			$table->string('title');
			$table->text('body');

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
		Schema::drop('carrousels');
	}

}
