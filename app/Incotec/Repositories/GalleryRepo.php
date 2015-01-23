<?php

namespace Incotec\Repositories;

use Incotec\Entities\Gallery;
use Incotec\Entities\Photo;

class GalleryRepo extends BaseRepo {

	public function getModel()
	{
		return new Gallery;
	}

	public function newGallery()
	{
		$gallery = new Gallery();
		return $gallery;
	}	

	public function listar($take = 10)
	{
		return Gallery::orderBy('created_at', 'desc')->with('photos')->paginate();
	}
} 