<?php

// Usuario

Route::get('/usuario/nuevo', ['as' => 'sign_up', 'uses' => 'UserController@signUp']);
Route::post('/usuario/nuevo', ['as' => 'register', 'uses' => 'UserController@register']);

Route::get('/usuarios', ['as' => 'usuarios', 'uses' => 'UserController@listar' ]);

Route::delete('/usuarios/{id}', ['as' => 'usuario_destroy', 'uses' => 'UserController@destroy']);