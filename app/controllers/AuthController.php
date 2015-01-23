<?php

use Incotec\Entities\User;
use Incotec\Repositories\PhotoRepo;
use Incotec\Repositories\UserRepo;
use Incotec\Managers\AccountManager;
use Incotec\Repositories\CourseRepo;

class AuthController extends BaseController {
 

 	protected $userRepo;
 	protected $photoRepo;

    public function __construct(UserRepo $userRepo,
    							CourseRepo $courseRepo,
    							PhotoRepo $photoRepo)
    {
        $this->userRepo  = $userRepo;
        $this->photoRepo  = $photoRepo;
        $this->courseRepo  = $courseRepo;
    }

	public function showLogin()
	{
		if (Auth::check())
		{           
			return Redirect::route('home');
		}

		$latest_photos = $this->photoRepo->findLatest(8);
		$cursos        = $this->courseRepo->findLatest(5);

		return View::make('admin.login',compact('latest_photos', 'cursos'));
	}

	public function postLogin()
	{
		$data = Input::only('email', 'password', 'remember');

		$credentials = ['email' => $data['email'], 'password' => $data['password']];

		if (Auth::attempt($credentials, $data['remember'])) 
		{
			return Redirect::route('home');
		}
		return Redirect::back()->with('msg', 'Datos incorrectos')->withInput();
	}
 
	public function logout()
	{		
		Auth::logout();

		return Redirect::route('login')->with('msg', 'Tu sesión ha sido cerrada correctamente.');
	}

	public function getForgotPassword()
	{
		$latest_photos = $this->photoRepo->findLatest(8);
		$cursos        = $this->courseRepo->findLatest(5);

		return View::make('admin.forgot', compact('latest_photos', 'cursos'));
	}

	public function postForgotPassword()
	{
		
		$validator = Validator::make(Input::All(), ['email' => 'required|email']);

		if ($validator->fails()) {
			return Redirect::route('forgot')->withErrors($validator)->withInput();
		} else {
			$user = User::where('email', '=', Input::get('email'));

			if ($user->count()) {
				$user 				 = $user->first();
				
				$code                = str_random(60);
				$password            = str_random(10);
				
				$user->code          = $code;
				$user->password_temp = $password;

				if ($user->save()) {
					Mail::send('emails.auth.forgot', [ 'link' => URL::route('account-recover', $code), 'username' => $user->full_name, 'password' => $password], function($message) use ($user) {
						$message->to($user->email, $user->full_name)->subject('Tu nueva contraseña.');
					});

					return Redirect::route('forgot')->with('succes', 'Hemos enviado una nueva contraseña a su correo electrónico.');
				}
			}
		}

		return Redirect::route('forgot')->with('msg', 'No se pudo solicitar nueva contraseña.');
	}

	public function getRecover($code)
	{
		$user = User::where('code', '=', $code)->where('password_temp', '!=', '');
		if ($user->count()) {

			$user = $user->first();

			$user->password      = $user->password_temp;
			
			$user->password_temp = '';
			$user->code          = '';

			if ($user->save()) {
				return Redirect::route('login')->with('succes', 'Su cuenta ha sido recuperada y puede iniciar sesión con su nueva contraseña.');
			}

		}
		return Redirect::route('login')->with('msg', 'No se ha podido recuperar su cuenta.');
	}

}
