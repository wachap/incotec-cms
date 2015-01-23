<?php

namespace Incotec\Repositories;

use Incotec\Entities\Photo;

class PhotoRepo extends BaseRepo {

	public function getModel()
	{
		return new Photo;
	}

	public function newPhoto()
	{
		$photo = new Photo();
		return $photo;
	}	

	public function findLatest($take = 5)
	{
		return $this->model->take($take)->orderBy('created_at', 'DESC')->with('gallery')->get();
	}

} 