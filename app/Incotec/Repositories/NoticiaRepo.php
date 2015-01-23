<?php

namespace Incotec\Repositories;

use Incotec\Entities\Noticia;

class NoticiaRepo extends BaseRepo {

	public function getModel()
	{
		return new Noticia;
	}

	public function newNoticia()
	{
		$noticia = new Noticia();
		return $noticia;
	}

} 