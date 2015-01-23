<?php

namespace Incotec\Repositories;

use Incotec\Entities\Programme;

class ProgrammeRepo extends BaseRepo {

	public function getModel()
	{
		return new Programme;
	}

	public function newProgramme()
	{
		$programme = new Programme();
		return $programme;
	}

}