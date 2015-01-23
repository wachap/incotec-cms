<?php 

namespace Incotec\Managers;

class RegisterManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'full_name'             => 'required',
            'email'                 => 'required|email|unique:users,email',
            'type'                  =>  '',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        return $rules;
    }

} 