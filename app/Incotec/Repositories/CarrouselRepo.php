<?php

namespace Incotec\Repositories;

use Incotec\Entities\Carrousel;

class CarrouselRepo extends BaseRepo {

	public function getModel()
	{
		return new Carrousel;
	}

	public function newCarrousel()
	{
		$carrousel = new Carrousel();
		return $carrousel;
	}	

} 