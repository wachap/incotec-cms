<?php namespace Incotec\Entities;

class Photo extends \Eloquent {
	protected $fillable = ['title', 'image_url'];
	protected $table = 'photos';

	public function gallery(){
		return $this->belongsTo('Incotec\Entities\Gallery');
	}
}
