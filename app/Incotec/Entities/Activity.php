<?php namespace Incotec\Entities;

class Activity extends \Eloquent {
	protected $fillable = ['title', 'date_begin', 'date_end', 'time', 'body', 'programme', 'available', 'slug'];
	protected $table = 'activities';
	protected $perPage = 5;

	public function programmes(){
		return $this->hasMany('Incotec\Entities\Programme');
	}

	public function delete()
	{
		// Borra todos los comentarios 
		foreach($this->programmes as $programme)
		{
			$programme->delete();
		}

		// Borramos el Post
		return parent::delete();
	}
}