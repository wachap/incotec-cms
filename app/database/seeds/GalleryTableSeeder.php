<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Incotec\Entities\Gallery;
use Incotec\Entities\Photo;

class GalleryTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$title = $faker->sentence($nbWords = 6);

			$gallery = Gallery::create([
				'title'			=>	$title,
				'body'			=>	$faker->text($maxNbChars = 200),
				'slug'			=>	\Str::slug($title),
				'available'		=>	true
			]);

			foreach(range(1, 5) as $index)
			{
				Photo::create([
					'title'			=>	$faker->sentence($nbWords = 6),
					'image_url'		=>	$faker->randomElement(['images/assets/2014/4.jpg', 'images/assets/2014/5.jpg', 'images/assets/2014/6.jpg']),
					'gallery_id'	=>	$gallery->id
				]);
			}
		}
	}

}