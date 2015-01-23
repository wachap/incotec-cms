<?php namespace Incotec\Entities;

class Carrousel extends \Eloquent {
	
	protected $fillable = ['image_url', 'title', 'body'];

	protected $table = 'carrousels';

}