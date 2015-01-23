<?php 

namespace Incotec\Managers;

class MensajeManager extends BaseManager
{
	
	public function getRules()
	{
		$rules = 
		[
			'full_name'       => 	'required',
			'email'           => 	'required|email',
			'phone'           => 	'required',
			'message_subject' => 	'required' . $this->entity->message_subject,
			'message'         => 	'required',
		];

		return $rules;
	}

	public function prepareData($data)
    {
        return $data;
    }

}