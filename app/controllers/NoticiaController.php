<?php

use Incotec\Entities\Noticia;
use Incotec\Managers\NoticiaManager;
use Incotec\Repositories\NoticiaRepo;
use Incotec\Repositories\CourseRepo;
use Incotec\Repositories\PhotoRepo;
use Incotec\Repositories\ActivityRepo;


class NoticiaController extends \BaseController {

	public function __construct(PhotoRepo $photoRepo,
								CourseRepo $courseRepo,
								NoticiaRepo $noticiaRepo,
								ActivityRepo $activityRepo)
	{
		$this->courseRepo   = $courseRepo;
		$this->photoRepo    = $photoRepo;
		$this->noticiaRepo  = $noticiaRepo;
		$this->activityRepo = $activityRepo;
	}

	public function index()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$activities    = $this->activityRepo->findLatest(4);
		$noticias      = $this->noticiaRepo->listar();
		$cursos       = $this->courseRepo->findLatest(5);

		return View::make('noticia.list', compact('latest_photos', 'activities', 'noticias', 'cursos'));
	}

	public function create()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		
		return View::make('noticia.form', compact('latest_photos'));
	}

	public function store()
	{
		
		$file = Input::file('image_url');
		
		$data = Input::only(['title', 'image_url', 'body']);
		
		$rules = 
		[
		'title'  	=> 'required',
		'image_url' => 'required|image|mimes:jpeg,jpg|max:1000',
		'body' 		=> 'required'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		} else {
			$getRealPath = 'images/assets/'.date('Y').'/';
			$noticia = new Noticia($data);
			$noticia->available = true;
						
			$noticia->image_url = $getRealPath.$data['image_url']->getClientOriginalName();

			$noticia->slug = \Str::slug($data['title']);
			$noticia->save();

			
			if ($noticia->save())
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
				if($miImg != $noticia->image_url)
				{
					$noticia->image_url = $getRealPath.$miImg;
					$noticia->save();
				}
			}
			

			
			return Redirect::route('noticia', [$noticia->slug, $noticia->id] )->with(['confirm' => 'Se inserto el registro correctamente.']);
		}		

		
	}

	public function show($slug, $id)
	{		
		$latest_photos = $this->photoRepo->findLatest(8);
		$noticia = $this->noticiaRepo->find($id);
		$activities = $this->activityRepo->findLatest(4);		
		$cursos       = $this->courseRepo->findLatest(5);

		return View::make('noticia.show',compact('latest_photos', 'activities', 'noticia', 'cursos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /noticia/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editar($id)
	{
		$noticia = $this->noticiaRepo->find($id);
		$latest_photos = $this->photoRepo->findLatest(8);
		
		return View::make('noticia.form', compact('latest_photos', 'noticia'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /noticia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{		

		$noticia = $this->noticiaRepo->find($id);

		$file = Input::file('image_url');

		if ( empty($file) ) {
			$data = Input::only(['title', 'body']);
			
		} else {
			$data = Input::only(['title', 'image_url', 'body']);
		}

		
		$rules = 
		[
		'title'  	=> 'required',
		'image_url' => 'image|mimes:jpeg|max:1000',
		'body' 		=> 'required'
		];


		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{

		return Redirect::back()->withInput()->withErrors($validation->messages());
		} else {
			if ( ! empty($file) ) 
			{
				File::delete($noticia->image_url);
			}

			$getRealPath = 'images/assets/'.date('Y').'/';
			$noticia->fill($data);
			if ( ! empty($file) ) 
			{
				$noticia->image_url = $getRealPath.$data['image_url']->getClientOriginalName();			
			}
			$noticia->slug = \Str::slug($data['title']);
			$noticia->save();
			if ( ! empty($file) ) 
			{
				if ( $noticia->save() )
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
					if($miImg != $noticia->image_url)
					{
						$noticia->image_url = $getRealPath.$miImg;						
						$noticia->save();
					}
				}			
			}
			
			return Redirect::route('noticia', [$noticia->slug, $noticia->id] )->with(['confirm' => 'Se edito el registro correctamente.']);
		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /noticia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{		
		$noticia = $this->noticiaRepo->find($id);
		File::delete($noticia->image_url);
		$this->noticiaRepo->eliminar($id);
		return Redirect::route('noticias');
	}

}