<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Incotec\Entities\Activity;
use Incotec\Entities\Programme;

class ActivityTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$title = $faker->sentence($nbWords = 6);

			$activity = Activity::create([
				'title'			=>	$title,
				'date_begin'	=>	$faker->date($format = 'Y-m-d', $max = 'now'),
				'date_end'		=>	$faker->date($format = 'Y-m-d', $max = 'now'),
				'time'			=>	'16:00 - 21:00',
				'body'			=>	$faker->text($maxNbChars = 400),
				'programme'		=>	$faker->text($maxNbChars = 400),
				'available'		=>	true,
				'slug'			=>	\Str::slug($title)		
			]);

			foreach(range(1, 5) as $index)
			{
				Programme::create([
					'title'			=>	$faker->sentence($nbWords = 6),
					'time'			=>	'16:00 - 17:00',
					'activity_id'	=>	$activity->id
				]);
			}
		}
	}

}