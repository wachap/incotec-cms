<?php

namespace Incotec\Repositories;

use Incotec\Entities\Course;

class CourseRepo extends BaseRepo {

	public function getModel()
	{
		return new Course;
	}

	public function newCourse()
	{
		$course = new Course();
		return $course;
	}	

} 