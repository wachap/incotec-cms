<?php namespace Incotec\Entities;

class Mensaje extends \Eloquent {
	
	protected $fillable = ['full_name', 'email', 'phone', 'message_subject', 'message'];
	protected $perPage = 5;
	protected $table = 'mensajes';

}