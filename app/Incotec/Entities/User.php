<?php namespace Incotec\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = ['full_name', 'email', 'password', 'type'];
	protected $perPage = 10;

	protected $table = 'users';

	protected $hidden = array('password', 'remember_token');

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = \Hash::make($value);
	}

}
