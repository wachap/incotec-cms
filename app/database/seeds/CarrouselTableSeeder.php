<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Incotec\Entities\Carrousel;

class CarrouselTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Carrousel::create([
				'image_url' =>	$faker->randomElement(['images/assets/2014/4.jpg', 'images/assets/2014/5.jpg', 'images/assets/2014/6.jpg']),
				'title'     =>	$faker->sentence($nbWords = 6),
				'body'      =>	$faker->text($maxNbChars = 200),
			]);
		}
	}

}