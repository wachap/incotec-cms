<?php

use Incotec\Entities\Photo;
use Incotec\Entities\Gallery;
use Incotec\Repositories\PhotoRepo;
use Incotec\Repositories\NoticiaRepo;
use Incotec\Repositories\GalleryRepo;
use Incotec\Repositories\CourseRepo;

class GalleryController extends \BaseController {

	public function __construct(PhotoRepo $photoRepo,	
								CourseRepo $courseRepo,							
								NoticiaRepo $noticiaRepo,
								GalleryRepo $galleryRepo)
	{
		$this->photoRepo = $photoRepo;
		$this->noticiaRepo = $noticiaRepo;
		$this->galleryRepo = $galleryRepo;
		$this->courseRepo = $courseRepo;
	}

	public function index()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$noticias      = $this->noticiaRepo->findLatest(4);				
		$galleries     = $this->galleryRepo->listar();
		$cursos        = $this->courseRepo->findLatest(5);

		return View::make('gallery.list',compact('latest_photos', 'galleries', 'noticias', 'cursos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /gallery/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		
		return View::make('gallery.form', compact('latest_photos'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /gallery
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only(['title', 'body']);

		$rules = 
		[
		'title'  		=> 'required',
		'body'  		=> 'required'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		} else {

			$gallery = new Gallery($data);

			$gallery->available = true;
			$gallery->slug = \Str::slug( $data['title'] );
			$gallery->save();
		}

		return Redirect::route('gallery', [$gallery->slug, $gallery->id] )->with(['confirm' => 'Se inserto el registro correctamente.']);
	}

	public function photoStore($id)
	{
		$file = Input::file('image_url');

		$data = Input::only(['title', 'image_url']);

		$rules = 
		[
		'title'  		=> 'required',
		'image_url' 	=> 'required|image|mimes:jpeg,jpg|max:1000'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());

		} else {

			$getRealPath = 'images/assets/'.date('Y').'/';

			$photo = new Photo($data);
			$photo->gallery_id = $id;
			$photo->image_url = $getRealPath.$data['image_url']->getClientOriginalName();
			$photo->save();

			if ($photo->save()) {
				$i = 0;
				
				$info = explode(".",$file->getClientOriginalName());
				
				$newFile = $file->getClientOriginalName();
				
				while(file_exists($getRealPath.$newFile))
				{
					$i++;
					$newFile = $info[0]."(".$i.")".".".$info[1];
				}
				
				$file->move($getRealPath, $newFile);
				
				if($newFile != $photo->image_url)
				{
					$photo->image_url = $getRealPath.$newFile;
					$photo->save();
				}
			}
		}

		return Redirect::back()->with(['confirm' => 'Se inserto el registro correctamente.']);
	}
	/**
	 * Display the specified resource.
	 * GET /gallery/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug, $id)
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$gallery = $this->galleryRepo->find($id);
		$cursos        = $this->courseRepo->findLatest(5);

		return View::make('gallery.show',compact('latest_photos', 'gallery', 'cursos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /gallery/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$latest_photos	= $this->photoRepo->findLatest(8);
		$gallery 	= $this->galleryRepo->find( $id );
		
		return View::make('gallery.form', compact('latest_photos', 'gallery'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /gallery/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$gallery = $this->galleryRepo->find($id);

		$data = Input::only(['title', 'body']);

		$rules = 
		[
		'title'  		=> 'required',
		'body'  		=> 'required'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		} else {

			$gallery->fill($data);

			$gallery->available = true;
			$gallery->slug = \Str::slug( $data['title'] );
			$gallery->save();
		}

		return Redirect::route('gallery', [$gallery->slug, $gallery->id] )->with(['confirm' => 'Se edito el registro correctamente.']);
	}

	public function photoUpdate($id)	
	{

		$file = Input::file('image_url');

		if ( empty($file) ) {
			$data = Input::only(['title']);
		} else {
			$data = Input::only(['title', 'image_url']);
		}

		$rules = 
		[
		'title'  		=> 'required',
		'image_url' 	=> 'image|mimes:jpeg,jpg|max:1000'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());

		} else {

			$photo = $this->photoRepo->find($id);
			if ( !empty($file) ) {
				File::delete($photo->image_url);
			}

			$getRealPath = 'images/assets/'.date('Y').'/';

			$photo->fill($data);

			if ( !empty($file) ) {
			$photo->image_url = $getRealPath.$data['image_url']->getClientOriginalName();
			}

			$photo->save();

			if ( !empty($file) ) 
			{
				if ($photo->save()) {
					$i = 0;
					
					$info = explode(".",$file->getClientOriginalName());
					
					$newFile = $file->getClientOriginalName();
					
					while(file_exists($getRealPath.$newFile))
					{
						$i++;
						$newFile = $info[0]."(".$i.")".".".$info[1];
					}
					
					$file->move($getRealPath, $newFile);
					
					if($newFile != $photo->image_url)
					{
						$photo->image_url = $getRealPath.$newFile;
						$photo->save();
					}
				}
			}
			
		}

		return Redirect::back()->with(['confirm' => 'Se edito el registro correctamente.']);
	}
	/**
	 * Remove the specified resource from storage.
	 * DELETE /gallery/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$gallery = $this->galleryRepo->find($id);		
		
		$this->galleryRepo->eliminar($id);
		return Redirect::route('galleries');
	}

	public function photoDestroy($id)
	{
		$photo = $this->photoRepo->find($id);
		File::delete($photo->image_url);
		$this->photoRepo->eliminar($id);

		return Redirect::back()->with(['confirm' => 'Se elimino el registro correctamente.']);	
	}
}