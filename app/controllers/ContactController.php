<?php

use Incotec\Repositories\PhotoRepo;
use Incotec\Repositories\NoticiaRepo;
use Incotec\Repositories\MensajeRepo;
use Incotec\Managers\MensajeManager;
use Incotec\Repositories\CourseRepo;



class ContactController extends \BaseController {

	public function __construct(PhotoRepo $photoRepo,	
								CourseRepo $courseRepo,	
								MensajeRepo $mensajeRepo,						
								NoticiaRepo $noticiaRepo)
	{
		$this->photoRepo = $photoRepo;
		$this->courseRepo = $courseRepo;
		$this->noticiaRepo = $noticiaRepo;
		$this->mensajeRepo = $mensajeRepo;
	}
	
	public function index()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$noticias = $this->noticiaRepo->findLatest(4);	
		$cursos        = $this->courseRepo->findLatest(5);

		return View::make('contact.index', compact('latest_photos', 'noticias', 'cursos'));
	}

	public function create()
	{
		//
	}


	public function listar()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$mensajes = $this->mensajeRepo->listar();

		return View::make('contact.list', compact('latest_photos', 'mensajes'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /contact
	 *
	 * @return Response
	 */
	public function store()
	{
 		$mensaje = $this->mensajeRepo->newMensaje();
 		
 		$manager = new MensajeManager($mensaje, Input::all());
 		$manager->save();

		return Redirect::route('contact')->with(['confirm' => 'Se envio el mensaje correctamente.']); 	
	}

	/**
	 * Display the specified resource.
	 * GET /contact/{id}
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
	 * GET /contact/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /contact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /contact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{	
		$this->mensajeRepo->eliminar($id);
		return Redirect::route('contact_list');
	}

}