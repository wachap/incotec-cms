<?php

namespace Incotec\Repositories;

use Incotec\Entities\Worker;

class WorkerRepo extends BaseRepo {

	public function getModel()
	{
		return new Worker;
	}

	public function newWorker()
	{
		$worker = new Worker();
		return $worker;
	}	

	public function getLeader($leader)
	{
		return Worker::where('job_type', '=', $leader)->get();
	}
} 