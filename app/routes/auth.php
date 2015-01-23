<?php



// Usuario

Route::get('/account', ['as' => 'account', 'uses' => 'UserController@account']);

Route::put('/account', ['as' => 'update_account', 'uses' => 'UserController@updateAccount']);



//noticia

Route::get('/noticia/nuevo', ['as' => 'noticia_create', 'uses' => 'NoticiaController@create']);

Route::post('/noticias', ['as' => 'noticia_store', 'before' => 'csrf', 'uses' => 'NoticiaController@store']);



Route::get('/noticias/{id}/editar', ['as' => 'noticia_edit', 'uses' => 'NoticiaController@editar']);

Route::put('/noticia/{id}', ['as' => 'noticia_update', 'before' => 'csrf', 'uses' => 'NoticiaController@update']);



Route::delete('/noticia/{id}', ['as' => 'noticia_destroy', 'uses' => 'NoticiaController@destroy']);





//eventos

Route::get('/evento/nuevo', ['as' => 'evento_create', 'uses' => 'ActivityController@create']);

Route::post('/eventos', ['as' => 'evento_store', 'before' => 'csrf', 'uses' => 'ActivityController@store']);

Route::post('/programmes/{id}', ['as' => 'programme_store', 'before' => 'csrf', 'uses' => 'ActivityController@programmeStore']);



Route::get('/eventos/{id}/editar', ['as' => 'evento_edit', 'uses' => 'ActivityController@edit']);

Route::put('/evento/{id}', ['as' => 'evento_update', 'before' => 'csrf', 'uses' => 'ActivityController@update']);

Route::put('/programme/{id}', ['as' => 'programme_update', 'before' => 'csrf', 'uses' => 'ActivityController@programmeUpdate']);



Route::delete('/evento/{id}', ['as' => 'evento_destroy', 'uses' => 'ActivityController@destroy']);

Route::delete('/programme/{id}', ['as' => 'programme_destroy', 'uses' => 'ActivityController@programmeDestroy']);





//carreras

Route::get('/carrera/nuevo', ['as' => 'carrera_create', 'uses' => 'CourseController@create']);

Route::post('/carreras', ['as' => 'carrera_store', 'before' => 'csrf', 'uses' => 'CourseController@store']);

Route::post('/downloads/{id}', ['as' => 'download_store', 'before' => 'csrf', 'uses' => 'CourseController@downloadStore']);



Route::get('/carreras/{id}/editar', ['as' => 'carrera_edit', 'uses' => 'CourseController@edit']);

Route::put('/carrera/{id}', ['as' => 'carrera_update', 'before' => 'csrf', 'uses' => 'CourseController@update']);

Route::put('/download/{id}', ['as' => 'download_update', 'before' => 'csrf', 'uses' => 'CourseController@downloadUpdate']);



Route::delete('/carrera/{id}', ['as' => 'carrera_destroy', 'uses' => 'CourseController@destroy']);

Route::delete('/download/{id}', ['as' => 'download_destroy', 'uses' => 'CourseController@downloadDestroy']);





//galerias

Route::get('/galeria/nuevo', ['as' => 'galeria_create', 'uses' => 'GalleryController@create']);

Route::post('/galerias', ['as' => 'galeria_store', 'before' => 'csrf', 'uses' => 'GalleryController@store']);

Route::post('/fotos/{id}', ['as' => 'photo_store', 'before' => 'csrf', 'uses' => 'GalleryController@photoStore']);



Route::get('/galerias/{id}/editar', ['as' => 'galeria_edit', 'uses' => 'GalleryController@edit']);

Route::put('/galeria/{id}', ['as' => 'galeria_update', 'before' => 'csrf', 'uses' => 'GalleryController@update']);

Route::put('/foto/{id}', ['as' => 'photo_update', 'before' => 'csrf', 'uses' => 'GalleryController@photoUpdate']);



Route::delete('/galeria/{id}', ['as' => 'galeria_destroy', 'uses' => 'GalleryController@destroy']);

Route::delete('/foto/{id}', ['as' => 'photo_destroy', 'uses' => 'GalleryController@photoDestroy']);



// Profesores

Route::get('/leader/nuevo', ['as' => 'leader_create', 'uses' => 'LeaderShipController@create']);

Route::post('/leaders', ['as' => 'leader_store', 'before' => 'csrf', 'uses' => 'LeaderShipController@store']);



Route::get('/leaders/{id}/editar', ['as' => 'leader_edit', 'uses' => 'LeaderShipController@edit']);

Route::put('/leader/{id}', ['as' => 'leader_update', 'before' => 'csrf', 'uses' => 'LeaderShipController@update']);



Route::delete('/leader/{id}', ['as' => 'leader_destroy', 'uses' => 'LeaderShipController@destroy']);





// Contacto Mensajes

Route::get('/mensajes', ['as' => 'contact_list', 'uses' => 'ContactController@listar']);



Route::delete('/mensaje/{id}', ['as' => 'contact_destroy', 'uses' => 'ContactController@destroy']);





// Carrousel

Route::put('/carrousel/{id}', ['as' => 'carrousel_update', 'before' => 'csrf', 'uses' => 'HomeController@updateCarrousel']);

Route::post('/carrousel/nuevo', ['as' => 'carrousel_create', 'before' => 'csrf', 'uses' => 'HomeController@insertCarrousel']);

Route::delete('/carrousel/{id}', ['as' => 'carrousel_delete', 'uses' => 'HomeController@deleteCarrousel']);