<?php

use Incotec\Managers\ActivityManager; 
use Incotec\Repositories\ActivityRepo;
use Incotec\Repositories\NoticiaRepo;
use Incotec\Repositories\CourseRepo;
use Incotec\Repositories\PhotoRepo;
use Incotec\Repositories\ProgrammeRepo;

class ActivityController extends \BaseController {

	public function __construct(PhotoRepo $photoRepo,
								CourseRepo $courseRepo,
								NoticiaRepo $noticiaRepo,
								ActivityRepo $activityRepo,
								ProgrammeRepo $programmeRepo)
	{
		$this->courseRepo    = $courseRepo;
		$this->photoRepo     = $photoRepo;
		$this->noticiaRepo   = $noticiaRepo;
		$this->activityRepo  = $activityRepo;
		$this->programmeRepo = $programmeRepo;
	}

	public function index()
	{
		$latest_photos = $this->photoRepo->findLatest(8);				
		$activities    = $this->activityRepo->listar();
		$noticias      = $this->noticiaRepo->findLatest(4);
		$cursos        = $this->courseRepo->findLatest(5);

		return View::make( 'activity.list',compact('latest_photos', 'activities', 'noticias', 'cursos') );
	}
	
	public function create()
	{
		return View::make( 'activity.form' );
	}
	
	public function store()
	{
		$activity = $this->activityRepo->newActivity();	
		$manager  = new ActivityManager( $activity, Input::all() );
		if ( $manager->save() ) 
		{
			return Redirect::route('activity', [$activity->slug, $activity->id] )->with(['alert-success' => 'Se inserto el registro correctamente.']);
		}
	}

	public function programmeStore( $id )
	{
		$data = Input::only( [ 'title', 'time' ] );

		$rules = 
		[
			'title'  		=> 'required',
			'time'  		=> 'required'
		];

		$validation = Validator::make( $data, $rules );

		if($validation->fails())
		{
			return Redirect::back()->withErrors($validation->messages());

		} else {
			$programme = $this->programmeRepo->newProgramme();
			$programme->fill($data);
			$programme->activity_id = $id;
			$programme->save();
		}

		return Redirect::back()->with( [ 'alert-success' => 'Se creo el registro correctamente.' ] );		
	}
	
	public function show( $slug ,$id )
	{
		$latest_photos = $this->photoRepo->findLatest(8);	
		$activity      = $this->activityRepo->find($id);	
		$noticias      = $this->noticiaRepo->findLatest(4);
		$cursos        = $this->courseRepo->findLatest(5);

		$this->notFoundUnless($activity); 

		return View::make( 'activity.show',compact( 'latest_photos', 'activity', 'noticias', 'cursos' ) );
	}

	public function edit( $id )
	{
		$activity      = $this->activityRepo->find($id);

		return View::make( 'activity.form', compact( 'activity' ) );
	}
	
	public function update( $id )
	{
		$activity = $this->activityRepo->find($id);
		$manager  = new ActivityManager( $activity, Input::all() );
		if ( $manager->save() ) 
		{
			return Redirect::route('activity', [$activity->slug, $activity->id] )->with(['alert-info' => 'Se edito el Evento correctamente.']);
		}
	}

	public function programmeUpdate($id)
	{
		$programme = $this->programmeRepo->find($id);

		$data = Input::only(['title', 'time']);

		$rules = 
		[
			'title' => 'required',
			'time'  => 'required'
		];

		$validation = Validator::make($data, $rules);

		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		} else {
			$programme->fill($data);
			$programme->save();
		}
		return Redirect::back()->with(['alert-info' => 'Se edito el registro correctamente.']);		
	}
	
	public function destroy($id)
	{
		$activity = $this->activityRepo->find($id);	
		$this->activityRepo->eliminar($id);
		return Redirect::route('activities')->with(['alert-warning' => 'Se elimino el Evento correctamente.']);
	}

	public function programmeDestroy($id)
	{
		$programme = $this->programmeRepo->find($id);				
		$this->programmeRepo->eliminar($id);
		return Redirect::back()->with(['alert-warning' => 'Se elimino la Actividad correctamente.']);		
	}

}