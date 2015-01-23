<?php 

namespace Incotec\Managers;

class WorkerManager extends BaseManager
{
	
	public function getRules()
	{
		$rules = 
		[
			'full_name' => 	'required',
			'image_url' => 	'required|image|mimes:jpeg,jpg|max:1000',
			'job_type'  => 	'required',
			'since'     => 	'required|date',
			'body'      => 	'required',
		];

		return $rules;
	}

	public function prepareData($data)
    {
        return $data;
    }

}
