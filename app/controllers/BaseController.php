<?php
use Incotec\Repositories\PhotoRepo;
class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function __construct(PhotoRepo $photoRepo)
    {
        $this->photoRepo = $photoRepo;
    }

    public function notFoundUnless($value)
    {
    	if (!$value) App::abort(404);
    }

}
