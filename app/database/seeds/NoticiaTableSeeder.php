<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Incotec\Entities\Noticia;

class NoticiaTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 15) as $index)
		{
			$title = $faker->sentence($nbWords = 6);

			Noticia::create([
				'title'		=>	$title,
				'image_url'	=>	'images/assets/2014/5.jpg',
				'body'		=>	$faker->text($maxNbChars = 600),
				'available'	=>	true,
				'slug'		=>	\Str::slug($title)
			]);
		}
	}

}