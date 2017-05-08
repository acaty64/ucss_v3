<?php

use App\Acceso;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

// ROUTES

Route::get('user/index', [
		'as'	=> 'consulta.user.index',
		'uses'	=> 'consulta\UserController@index',	
	])->middleware(Authorize::class.':is_consulta,'.Acceso::class);
