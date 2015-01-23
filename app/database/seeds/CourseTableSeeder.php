<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Incotec\Entities\Course;
use Incotec\Entities\Download;

class CourseTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 20) as $index)
		{
			$title = $faker->sentence($nbWords = 6);

			$course = Course::create([
				'title'			=>	$title,
				'instructor'	=>	$faker->name,
				'image_url'		=>	'images/assets/2014/5.jpg',
				'address'		=>	'12 meses',
				'course_level'	=>	$faker->randomElement(['profesional', 'tecnico', 'curso']),
				'body'			=>	$faker->text($maxNbChars = 200),
				'slug'			=>	\Str::slug($title),
				'available'		=>	true
			]);

			foreach(range(1, 5) as $index)
			{
				Download::create([
					'file_type'		=>	$faker->randomElement(['material', 'modulos', 'horario']),
					'description'	=>	$faker->sentence($nbWords = 7),
					'file_url'		=>	'data/courses/1.pdf',
					'course_id'		=>	$course->id
				]);
			}
		}
	}

}