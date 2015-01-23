<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mensajes', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('full_name');
			$table->string('email');
			$table->string('phone', 25);
			$table->enum('message_subject', ['dudas', 'informacion_de_la_carrera', 'sugerencia_de_mejora']);
			$table->text('message');

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
		Schema::drop('mensajes');
	}

}
