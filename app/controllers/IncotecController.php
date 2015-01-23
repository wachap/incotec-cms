<?php

use Incotec\Repositories\PhotoRepo;
use Incotec\Repositories\CourseRepo;

class IncotecController extends \BaseController {

	public function __construct(PhotoRepo $photoRepo,
								CourseRepo $courseRepo)
	{
		$this->courseRepo = $courseRepo;
		$this->photoRepo  = $photoRepo;
	}

	public function index()
	{
		$latest_photos = $this->photoRepo->findLatest(8);						
		$cursos        = $this->courseRepo->findLatest(5);

		return View::make('incotec.index',compact('latest_photos', 'cursos'));
	}
} 