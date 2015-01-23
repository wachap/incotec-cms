<?php 
namespace Incotec\Managers;

class ActivityManager extends BaseManager {

    public function getRules()
    {
        $rules = 
        [
            'title'         => 'required',
            'date_begin'    => 'required|date',
            'date_end'      => 'required|date',
            'time'          => 'required',
            'body'          => 'required',
            'programme'     => 'required'
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        $data = array_add( $data, 'available', true );
        $data = array_add( $data, 'slug', \Str::slug($data['title']) );
       
        return $data;
    }
} 