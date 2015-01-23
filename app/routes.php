<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/error-404', ['as' => 'error_404', 'uses' => 'HomeController@error404']);
Route::get('/error-503', ['as' => 'error_503', 'uses' => 'HomeController@error503']);

Route::get('/image/{year}/{src}/{h?}', ['as' => 'imagen', function($year, $src, $h=75) {	
	$cacheimage = Image::cache(function($image) use ( $year, $src, $h ) 
	{
		return $image->make( asset( 'images/assets/'.$year.'/'.$src ) )->resize( null, $h, function($constraint)
		{
			$constraint->aspectRatio();
		} );
	}, true );

	return Response::make( $cacheimage, 200, [ 'Content-type' => 'image/jpeg' ] );
}] );


Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// Noticias
Route::get('/noticias', ['as' => 'noticias', 'uses' => 'NoticiaController@index']);
Route::get('/noticia/{slug}/{id}', ['as' => 'noticia', 'uses' => 'NoticiaController@show']);

// Eventos
Route::get('/eventos', ['as' => 'activities', 'uses' => 'ActivityController@index']);
Route::get('/evento/{slug}/{id}', ['as' => 'activity', 'uses' => 'ActivityController@show']);

// Carreras
Route::get('/carreras', ['as' => 'courses', 'uses' => 'CourseController@index']);
Route::get('/carrera/{slug}/{id}', ['as' => 'course', 'uses' => 'CourseController@show']);

// Galerias
Route::get('/galerias', ['as' => 'galleries', 'uses' => 'GalleryController@index']);
Route::get('/galeria/{slug}/{id}', ['as' => 'gallery', 'uses' => 'GalleryController@show']);

// Plana Aadministrativa
route::get('/plana-administrativa', ['as' => 'leadership', 'uses' => 'LeaderShipController@index']);

// Incotec
route::get('/incotec', ['as' => 'incotec', 'uses' => 'IncotecController@index']);

// Contacto
Route::get('/contacto', ['as' => 'contact', 'uses' => 'ContactController@index']);
Route::post('/contacto', ['as' => 'contact_store', 'before' => 'csrf', 'uses' => 'ContactController@store']);

// Login
Route::post('/login', ['as' => 'login', 'before' => 'csrf', 'uses' => 'AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'before' => 'auth', 'uses' => 'AuthController@logout']);

Route::group(['before' => 'guest'], function ()
{
	Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@showLogin']);
	Route::get('/forgot-password', ['as' => 'forgot', 'uses' => 'AuthController@getForgotPassword']); 
	Route::post('/forgot-password', ['as' => 'forgot-post', 'uses' => 'AuthController@postForgotPassword']); 
	Route::get('/recover/{code}', ['as' => 'account-recover', 'uses' => 'AuthController@getRecover']);
});


Route::group(['before' => 'auth'], function () 
{
    require ( __DIR__ . '/routes/auth.php' );

    Route::group(['before' => 'is_admin'], function () 
    {
        require ( __DIR__ . '/routes/admin.php' );
    });
});

App::missing( function( $exception )
{
	return Redirect::route('error_404');
} );

// mantenimiento
App::down( function()
{
	return Redirect::route('error_503');	
} );