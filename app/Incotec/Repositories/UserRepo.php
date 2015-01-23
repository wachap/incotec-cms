<?php

namespace Incotec\Repositories;

use Incotec\Entities\User;

class UserRepo extends BaseRepo {

	public function getModel()
	{
		return new User;
	}

	public function newUser()
	{
		$user = new User();
		$user->type = 'user';
		return $user;
	}	

} 