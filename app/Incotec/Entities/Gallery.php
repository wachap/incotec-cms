<?php namespace Incotec\Entities;

class Gallery extends \Eloquent {
	protected $fillable = ['title', 'body'];
	protected $table = 'galleries';
	protected $perPage = 3;

	public function photos(){
		return $this->hasMany('Incotec\Entities\Photo');
	}

	public function delete()
	{
		// Borra todos los comentarios 
		foreach($this->photos as $photo)
		{
			\File::delete($photo->image_url);
			$photo->delete();
		}

		// Borramos el Post
		return parent::delete();
	}
}