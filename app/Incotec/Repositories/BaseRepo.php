<?php namespace Incotec\Repositories;

abstract class BaseRepo {

	protected $model;

	public function __construct()
	{
		$this->model = $this->getModel();
	}

	abstract public function getModel();

	public function find($id)
	{
		$modelo = $this->model->find($id);
		if (is_null ($modelo))
		{
			\App::abort(404);
		}
		return $modelo;
	}

	public function findLatest($take = 5)
	{
		return $this->model->take($take)->orderBy('created_at', 'DESC')->get();
	}
	
	public function listar()
	{
		return $this->model->orderBy('created_at', 'desc')->paginate();
	}

	public function eliminar($id)
	{
		$objeto = $this->model->findOrFail($id);
		if (is_null ($objeto))
		{
			\App::abort(404);
		}
        $objeto->delete();		        
	}	


}