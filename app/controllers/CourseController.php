<?php

use Incotec\Entities\Course;
use Incotec\Entities\Download;
use Incotec\Repositories\ActivityRepo;
use Incotec\Repositories\CourseRepo;
use Incotec\Repositories\PhotoRepo;
use Incotec\Repositories\DownloadRepo;

class CourseController extends \BaseController {

	public function __construct(PhotoRepo $photoRepo,								
								CourseRepo $courseRepo,
								ActivityRepo $activityRepo,
								DownloadRepo $downloadRepo)
	{
		$this->photoRepo = $photoRepo;
		$this->courseRepo = $courseRepo;
		$this->activityRepo = $activityRepo;
		$this->downloadRepo = $downloadRepo;
	}

	public function index()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$activities    = $this->activityRepo->findLatest(3);				
		$courses       = $this->courseRepo->listar();
		$cursos        = $this->courseRepo->findLatest(5);

		return View::make('course.list',compact('latest_photos', 'activities', 'courses', 'cursos'));
	}


	public function create()
	{
		$latest_photos = $this->photoRepo->findLatest(8);

		return View::make('course.form', compact('latest_photos'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /course
	 *
	 * @return Response
	 */
	public function store()
	{
		$file = Input::file('image_url');

		$data = Input::only(['title', 'instructor', 'image_url', 'address', 'course_level', 'body' ]);

		$rules = 
		[
		'title'  		=> 'required',
		'instructor'  	=> 'required',
		'image_url'		=> 'required|image|mimes:jpeg,jpg|max:1000',
		'address'  		=> 'required',
		'course_level'  => 'required',
		'body'  		=> 'required'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		} else {
			$getRealPath = 'images/assets/courses/';

			$course = new Course($data);
			
			$course->image_url = $getRealPath.$data['image_url']->getClientOriginalName();

			$course->available = true;
			$course->slug = \Str::slug( $data['title'] );
			$course->save();

			if ($course->save())
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
				if($miImg != $course->image_url)
				{
					$course->image_url = $getRealPath.$miImg;
					$course->save();
				}
			}
		}

		return Redirect::route('course', [$course->slug, $course->id] )->with(['confirm' => 'Se inserto el registro correctamente.']);
	}

	public function downloadStore($id)
	{

		$file = Input::file('file_url');

		$data = Input::only(['file_type', 'description', 'file_url']);

		$rules = 
		[
		'file_type'  		=> 'required',
		'description'  		=> 'required',
		'file_url'			=> 'required'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());

		} else {

			$getRealPath = 'data/courses/';

			$download = new Download($data);
			$download->course_id = $id;
			$download->file_url = $getRealPath.$data['file_url']->getClientOriginalName();
			$download->save();

			if ($download->save()) {
				$i = 0;
				//separamos el nombre de la img y la extensión
				$info = explode(".",$file->getClientOriginalName());
				//asignamos de nuevo el nombre de la imagen completo
				$newFile = $file->getClientOriginalName();
				 //mientras el archivo exista iteramos y aumentamos i
				while(file_exists($getRealPath.$newFile))
				{
					$i++;
					$newFile = $info[0]."(".$i.")".".".$info[1];
				}
				//guardamos la imagen con otro nombre ej foto(1).jpg || foto(2).jpg etc
				$file->move($getRealPath, $newFile);
				//si ha cambiado el nombre de la foto por el original actualizamos el campo foto de la bd
				if($newFile != $download->file_url)
				{
					$download->file_url = $getRealPath.$newFile;
					$download->save();
				}
			}
		}

		return Redirect::back()->with(['confirm' => 'Se inserto el registro correctamente.']);		

	}

	/**
	 * Display the specified resource.
	 * GET /course/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug, $id)
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$course        = $this->courseRepo->find($id);
		$activities    = $this->activityRepo->findLatest(3);	
		$cursos        = $this->courseRepo->findLatest(5);	

		return View::make('course.show',compact('latest_photos', 'activities', 'course', 'cursos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /course/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$course = $this->courseRepo->find($id);

		return View::make('course.form', compact('latest_photos', 'course'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /course/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$course = $this->courseRepo->find($id);

		$file = Input::file('image_url');

		if ( empty($file) ) {
			$data = Input::only(['title', 'instructor', 'address', 'course_level', 'body' ]);
			
		} else {
			$data = Input::only(['title', 'instructor', 'image_url','address', 'course_level', 'body' ]);
		}
		

		$rules = 
		[
		'title'  		=> 'required',
		'instructor'  	=> 'required',
		'image_url' 	=> 'image|mimes:jpeg|max:1000',
		'address'  		=> 'required',
		'course_level'  => 'required',
		'body'  		=> 'required'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		} else {	
			if ( ! empty($file) ) 
			{
				File::delete($course->image_url);
			}
			$getRealPath = 'images/assets/courses/';
			$course->fill($data);
			if ( ! empty($file) ) 
			{
				$course->image_url = $getRealPath.$data['image_url']->getClientOriginalName();			
			}
			$course->slug = \Str::slug( $data['title'] );
			$course->save();

			if ( ! empty($file) ) 
			{
				if ( $course->save() )
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
					if($miImg != $course->image_url)
					{
						$course->image_url = $getRealPath.$miImg;
						
						$course->save();
					}
				}			
			}

		}

		return Redirect::route('course', [$course->slug, $course->id] )->with(['confirm' => 'Se edito el registro correctamente.']);
	}

	public function downloadUpdate($id)
	{

		$file = Input::file('file_url');

		if ( empty($file) ) {
			$data = Input::only(['file_type', 'description']);
		} else {
			
			$data = Input::only(['file_type', 'description', 'file_url']);
		}	

		$rules = 
		[
		'file_type'  		=> 'required',
		'description'  		=> 'required'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());

		} else {
			$download = $this->downloadRepo->find($id);
			if ( !empty($file) ) {
				File::delete($download->file_url);
			}
			

			$getRealPath = 'data/courses/';

			
			$download->fill($data);
			
			if ( !empty($file) ) {
				$download->file_url = $getRealPath.$data['file_url']->getClientOriginalName();
			}
			

			$download->save();

			if ( !empty($file) ) 
			{
			
				if ($download->save()) {
					$i = 0;
					//separamos el nombre de la img y la extensión
					$info = explode(".",$file->getClientOriginalName());
					//asignamos de nuevo el nombre de la imagen completo
					$newFile = $file->getClientOriginalName();
					 //mientras el archivo exista iteramos y aumentamos i
					while(file_exists($getRealPath.$newFile))
					{
						$i++;
						$newFile = $info[0]."(".$i.")".".".$info[1];
					}
					//guardamos la imagen con otro nombre ej foto(1).jpg || foto(2).jpg etc
					$file->move($getRealPath, $newFile);
					//si ha cambiado el nombre de la foto por el original actualizamos el campo foto de la bd
					if($newFile != $download->file_url)
					{
						$download->file_url = $getRealPath.$newFile;
						$download->save();
					}
				}

			}
			
		}	


		return Redirect::back()->with(['confirm' => 'Se edito el registro correctamente.']);		


		

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /course/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$course = $this->courseRepo->find($id);		
		File::delete($course->image_url);
		$this->courseRepo->eliminar($id);
		return Redirect::route('courses');
	}


	public function downloadDestroy($id)
	{
		$download = $this->downloadRepo->find($id);
		File::delete($download->file_url);
		$this->downloadRepo->eliminar($id);

		return Redirect::back()->with(['confirm' => 'Se elimino el registro correctamente.']);	
	}
}
