<?php

use Incotec\Entities\User;
use Incotec\Repositories\PhotoRepo;
use Incotec\Repositories\UserRepo;
use Incotec\Managers\AccountManager;
use Incotec\Managers\RegisterManager;

class UserController extends BaseController {

	protected $userRepo;
	protected $photoRepo;

	public function __construct(UserRepo $userRepo,
								PhotoRepo $photoRepo)
	{
		$this->userRepo  = $userRepo;
		$this->photoRepo  = $photoRepo;
	}

	public function listar()
	{
		$usuarios = $this->userRepo->listar();

		return View::make('admin.usuarios',compact('usuarios'));
	}

	public function signUp()
	{
		$latest_photos = $this->photoRepo->findLatest(8);

		return View::make('admin.register',compact('latest_photos'));
	}
 	
 	public function register()
 	{ 		
 		$user = $this->userRepo->newUser();;
 		
 		$manager = new RegisterManager( $user, Input::all() );
 		$manager->save();
		
		return Redirect::route('home'); 	

 	}

 	public function account()
 	{
 		$user = Auth::user();
 		$latest_photos = $this->photoRepo->findLatest(8);

		return View::make('admin.register',compact('latest_photos', 'user'));
 	}

 	public function updateAccount()
 	{
 		$user = Auth::user();
 		
 		$manager = new AccountManager($user, Input::all());
 		$manager->save();
		
		return Redirect::route('home'); 				
 	}

 	public function destroy($id)
 	{
 		$user = $this->userRepo->find($id);

 		$user->delete();

 		return Redirect::route('usuarios');
 	}

}
