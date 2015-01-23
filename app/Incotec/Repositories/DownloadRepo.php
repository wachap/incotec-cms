<?php

namespace Incotec\Repositories;

use Incotec\Entities\Download;

class DownloadRepo extends BaseRepo {

	public function getModel()
	{
		return new Download;
	}

	public function newDownload()
	{
		$download = new Download();
		return $download;
	}	
	
	// public function listAll($id)
	// {
	// 	return Download::where('course_id', '=', $id)->orderBy('created_at', 'DESC')->get();
	// }

} 