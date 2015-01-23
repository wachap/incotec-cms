<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('ActivityTableSeeder');		
		$this->call('CourseTableSeeder');		
		$this->call('GalleryTableSeeder');		
		$this->call('WorkerTableSeeder');
		$this->call('NoticiaTableSeeder');
		$this->call('CarrouselTableSeeder');
		$this->call('MensajeTableSeeder');
	}

}
