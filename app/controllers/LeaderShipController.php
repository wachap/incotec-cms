<?php

use Incotec\Repositories\ActivityRepo;
use Incotec\Repositories\NoticiaRepo;
use Incotec\Repositories\WorkerRepo;
use Incotec\Repositories\PhotoRepo;
use Incotec\Managers\WorkerManager;
use Incotec\Repositories\CourseRepo;

class LeaderShipController extends \BaseController {

	public function __construct(PhotoRepo $photoRepo,
								CourseRepo $courseRepo,
								NoticiaRepo $noticiaRepo,
								ActivityRepo $activityRepo,
								WorkerRepo $workerRepo)
	{
		$this->noticiaRepo  = $noticiaRepo;
		$this->activityRepo = $activityRepo;
		$this->workerRepo   = $workerRepo;
		$this->photoRepo    = $photoRepo;
		$this->courseRepo   = $courseRepo;
	}

	public function index()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$noticias      = $this->noticiaRepo->findLatest(4);
		$cursos        = $this->courseRepo->findLatest(5);
		
		$directores    = $this->workerRepo->getLeader('Director');
		$profesores    = $this->workerRepo->getLeader('Profesor');
		$secretarias   = $this->workerRepo->getLeader('Secretaria');

		return View::make('leadership.index',compact('latest_photos', 'directores', 'profesores', 'secretarias', 'noticias', 'cursos' ));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /leadership/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		
		return View::make('leadership.form', compact('latest_photos'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /leadership
	 *
	 * @return Response
	 */
	public function store()
	{
		$worker = $this->workerRepo->newWorker();;
 		
 		$manager = new WorkerManager($worker, Input::all());
 		
 		$manager->save();

 		// File
 		$data = Input::all();
 		$worker->available = true;
 		$file = Input::file('image_url');
 		$getRealPath = 'images/assets/'.date('Y').'/';
 		$worker->image_url = $getRealPath.$data['image_url']->getClientOriginalName();


 		$worker->save();

 		if ($worker->save())
		{
			$i = 0;
			//separamos el nombre de la img y la extensión
			$info = explode(".",$file->getClientOriginalName());
			//asignamos de nuevo el nombre de la imagen completo
			$miImg = $file->getClientOriginalName();
			 //mientras el archivo exista iteramos y aumentamos i
			while(file_exists($getRealPath.$miImg))
			{
				$i++;
				$miImg = $info[0]."(".$i.")".".".$info[1];
			}
			//guardamos la imagen con otro nombre ej foto(1).jpg || foto(2).jpg etc
			$file->move($getRealPath, $miImg);
			//si ha cambiado el nombre de la foto por el original actualizamos el campo foto de la bd
			if($miImg != $worker->image_url)
			{
				$worker->image_url = $getRealPath.$miImg;
				$worker->save();
			}
		}		
		return Redirect::route('leadership')->with(['confirm' => 'Se guardo el registro correctamente.']);
	}

	/**
	 * Display the specified resource.
	 * GET /leadership/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /leadership/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$worker = $this->workerRepo->find($id);

		return View::make('leadership.form', compact('latest_photos' , 'worker'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /leadership/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		

		$worker = $this->workerRepo->find($id);

		$file = Input::file('image_url');

		if ( empty($file) ) {
			$data = Input::only(['full_name', 'job_type', 'since', 'body']);
			
		} else {
			$data = Input::only(['full_name', 'image_url', 'job_type', 'since', 'body']);
		}

		
		$rules = 
		[
			'full_name' => 	'required',
			'image_url' => 	'image|mimes:jpeg,jpg|max:1000',
			'job_type'  => 	'required',
			'since'     => 	'required|date',
			'body'      => 	'required',
		];


		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{

		return Redirect::back()->withInput()->withErrors($validation->messages());
		} else {
			if ( ! empty($file) ) 
			{
				File::delete($worker->image_url);
			}

			$getRealPath = 'images/assets/'.date('Y').'/';
			$worker->fill($data);
			if ( ! empty($file) ) 
			{
				$worker->image_url = $getRealPath.$data['image_url']->getClientOriginalName();			
			}
			$worker->save();
			if ( ! empty($file) ) 
			{
				if ( $worker->save() )
				{
					$i = 0;
					//separamos el nombre de la img y la extensión
					$info = explode(".",$file->getClientOriginalName());
					//asignamos de nuevo el nombre de la imagen completo
					$miImg = $file->getClientOriginalName();
					 //mientras el archivo exista iteramos y aumentamos i
					while(file_exists($getRealPath.$miImg))
					{
						$i++;
						$miImg = $info[0]."(".$i.")".".".$info[1];
					}
					//guardamos la imagen con otro nombre ej foto(1).jpg || foto(2).jpg etc
					$file->move($getRealPath, $miImg);
					//si ha cambiado el nombre de la foto por el original actualizamos el campo foto de la bd
					if($miImg != $worker->image_url)
					{
						$worker->image_url = $getRealPath.$miImg;
						$worker->save();
					}
				}			
			}
			
			return Redirect::route('leadership')->with(['confirm' => 'Se edito el registro correctamente.']);
		}		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /leadership/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$worker = $this->workerRepo->find($id);
		File::delete($worker->image_url);
		$this->workerRepo->eliminar($id);
		return Redirect::route('leadership');
	}

}