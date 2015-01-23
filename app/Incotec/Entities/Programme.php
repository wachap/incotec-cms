<?php namespace Incotec\Entities;

class Programme extends \Eloquent {
	protected $fillable = ['title', 'time'];

	protected $table = 'programmes';

	public function activity(){
		return $this->belongsTo('Incotec\Entities\Activity');
	}
}