<?php namespace Incotec\Entities;

class Noticia extends \Eloquent {
	protected $fillable = ['title', 'image_url', 'body'];
	protected $table = 'noticias';
	protected $perPage = 6;

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] =  \Str::slug($value);
	}

}