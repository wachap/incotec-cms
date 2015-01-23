<?php

namespace Incotec\Repositories;

use Incotec\Entities\Mensaje;

class MensajeRepo extends BaseRepo {

	public function getModel()
	{
		return new Mensaje;
	}

	public function newMensaje()
	{
		$mensaje = new Mensaje();
		return $mensaje;
	}	

} 