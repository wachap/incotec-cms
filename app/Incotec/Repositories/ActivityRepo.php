<?php

namespace Incotec\Repositories;

use Incotec\Entities\Activity;

class ActivityRepo extends BaseRepo {

	public function getModel()
	{
		return new Activity;
	}

	public function newActivity()
	{
		$activity = new Activity();
		return $activity;
	}	

} 