<?php



use Incotec\Repositories\ActivityRepo;

use Incotec\Repositories\NoticiaRepo;

use Incotec\Repositories\PhotoRepo;

use Incotec\Repositories\CourseRepo;

use Incotec\Repositories\CarrouselRepo;

use Incotec\Managers\CarrouselManager;



class HomeController extends BaseController {



	protected $activityRepo;

	protected $noticiaRepo;

	protected $CarrouselRepo;





	public function __construct(ActivityRepo $activityRepo,

								CourseRepo $courseRepo,

								NoticiaRepo $noticiaRepo,

								CarrouselRepo $carrouselRepo,

								PhotoRepo $photoRepo)

	{

		$this->activityRepo  = $activityRepo;

		$this->courseRepo    = $courseRepo;

		$this->noticiaRepo   = $noticiaRepo;

		$this->photoRepo     = $photoRepo;

		$this->carrouselRepo = $carrouselRepo;

	}



	public function index()

	{

		$latest_activities = $this->activityRepo->findLatest(3);

		$latest_noticias   = $this->noticiaRepo->findLatest(3);

		$latest_photos     = $this->photoRepo->findLatest(8);

		$carrousels        = $this->carrouselRepo->listar();

		$cursos           = $this->courseRepo->findLatest(5);



		return View::make('home', compact('latest_activities', 'latest_noticias', 'latest_photos', 'carrousels', 'cursos'));

	}

	public function deleteCarrousel($id)
	{
		$carrousel = $this->carrouselRepo->find($id);
		if ($carrousel->image_url != 'images/static/incotec.jpg') {
			File::delete($carrousel->image_url);
		}		
		$this->carrouselRepo->eliminar($id);
		return Redirect::back();
	}

	public function insertCarrousel()
	{
		$carrousel            = $this->carrouselRepo->newCarrousel();			
		$carrousel->image_url = 'images/static/incotec.jpg';
		$carrousel->title     = 'Nuevo';
		$carrousel->body      = 'Nuevo';
		$carrousel->save();
	
		return Redirect::back();
	}


	public function updateCarrousel($id)

	{

		$carrousel = $this->carrouselRepo->find($id);

		$file = Input::file('image_url');



		if ( empty($file) ) {

			$data = Input::only(['title', 'body']);

			

		} else {

			$data = Input::only(['image_url', 'title', 'body']);

		}



		

		$rules = 

		[

			'image_url' => 	'image|mimes:jpeg,jpg|max:1000',

			'title'     => 	'required',

			'body'      => 	'',

		];





		$validation = Validator::make($data, $rules);



		if($validation->fails())

		{



		return Redirect::back()->withInput()->withErrors($validation->messages());

		} else {

			if ( ! empty($file) ) 

			{

				File::delete($carrousel->image_url);

			}



			$getRealPath = 'images/carrousel/';

			$carrousel->fill($data);

			if ( ! empty($file) ) 

			{

				$carrousel->image_url = $getRealPath.$data['image_url']->getClientOriginalName();			

			}

			$carrousel->save();

			if ( ! empty($file) ) 

			{

				if ( $carrousel->save() )

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

					if($miImg != $carrousel->image_url)

					{

						$carrousel->image_url = $getRealPath.$miImg;

						$carrousel->save();

					}

				}			

			}

			

			return Redirect::route('home');

		}		





	}



	public function error404()

	{

		$latest_photos     = $this->photoRepo->findLatest(8);	

		$cursos           = $this->courseRepo->findLatest(5);	



		return View::make('error.error404', compact('latest_photos', 'cursos'));

	}



	public function error503()

	{

		$latest_photos     = $this->photoRepo->findLatest(8);		

		$cursos           = $this->courseRepo->findLatest(5);



		return View::make('error.error503', compact('latest_photos', 'cursos' ));

	}

}

