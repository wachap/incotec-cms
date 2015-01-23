<?php namespace Incotec\Entities;

class Worker extends \Eloquent {
	
	protected $fillable = ['full_name', 'image_url', 'job_type', 'since', 'body'];

	protected $table = 'workes';

	public function setAvailableAttribute()
	{
		$this->attributes['available'] = true;
	}
}