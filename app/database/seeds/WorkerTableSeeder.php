<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Incotec\Entities\Worker;

class WorkerTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Worker::create([
				'full_name'	=>	$faker->name,
				'image_url'	=>	$faker->randomElement(['images/assets/2014/4.jpg', 'images/assets/2014/5.jpg', 'images/assets/2014/6.jpg']),
				'job_type'	=>	$faker->randomElement(['Director', 'Secretaria', 'Profesor']),
				'since'		=>	$faker->date($format = 'Y-m-d', $max = 'now'),
				'body'		=>	$faker->text($maxNbChars = 200),
				'available'	=>	true
			]);
		}
	}

}