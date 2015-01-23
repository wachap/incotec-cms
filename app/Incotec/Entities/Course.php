<?php namespace Incotec\Entities;

class Course extends \Eloquent {
	protected $fillable = ['title', 'instructor', 'image_url', 'address', 'course_level', 'body' ];
	protected $table = 'courses';
	protected $perPage = 15;

	public function downloads(){
		return $this->hasMany('Incotec\Entities\Download');
	}

	public function delete()
	{
		// Borra todos los comentarios 
		foreach($this->downloads as $download)
		{
			$download->delete();
		}

		// Borramos el Post
		return parent::delete();
	}
}