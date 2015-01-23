<?php 

namespace Incotec\Managers;

class CarrouselManager extends BaseManager
{
	
	public function getRules()
	{
		$rules = 
		[
			'image_url' => 	'image|mimes:jpeg,jpg|max:1000',
			'title'     => 	'required',
			'body'      => 	'required',
		];

		return $rules;
	}

	public function prepareData($data)
    {
        return $data;
    }

}
