<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Incotec\Entities\Mensaje;

class MensajeTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Mensaje::create([
				'full_name'       => $faker->name,
				'email'           => $faker->email,
				'phone'           => $faker->phoneNumber,
				'message_subject' => $faker->randomElement(['dudas','informacion_de_la_carrera','sugerencia_de_mejora']),
				'message'         =>$faker->text($maxNbChars = 200),
			]);
		}
	}

}