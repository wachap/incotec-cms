<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Incotec\Entities\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create([           
            'full_name' => 'Gean Carlos',
			'email'     => 'w4ch4p@gmail.com',
			'password'  => '123456',
			'type'		=> 'admin'
        ]);

		$faker = Faker::create();


		foreach(range(1, 10) as $index)
		{
			User::create([
				'full_name' => $faker->name,
				'email'     => $faker->email,
				'password'  => '123456',
				'type'		=> $faker->randomElement(['admin', 'user'])
			]);
		}
	}

}