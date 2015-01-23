<?php namespace Incotec\Entities;

class Download extends \Eloquent {
	protected $fillable = ['file_type', 'description', 'file_url'];
	protected $table = 'downloads';

	public function course(){
		return $this->belongsTo('Incotec\Entities\Course');
	}
}