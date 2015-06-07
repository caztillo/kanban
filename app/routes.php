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

Route::get('/', array('as' => 'inicio', 'uses' => 'AdminController@index'));
Route::resource('dependencias', 'DependenciasController',array('except' => array('show')));
Route::resource('anos_fiscales', 'AnosFiscalesController',array('except' => array('show')));
Route::resource('organizaciones', 'OrganizacionesController');
Route::get('/anos_fiscales/search', array('uses' => 'AnosFiscalesController@search'));
Route::get('/dependencias/search', array('uses' => 'DependenciasController@search'));
Route::get('/organizaciones/search', array('uses' => 'OrganizacionesController@search'));

Route::get('/login', array('uses' => 'AdminController@login'));
Route::group(['before' => 'auth'], function()
{

    /*Route::resource('/', 'IndexController', ['only' => ['index'] ]);

    Route::get('eventos/lista', 'IndexController@eventosCalendario');

    Route::get('perfil',  ['as' => 'perfil','uses'=>'UsersController@edit']);

    Route::get('perfil/{id}/{alias?}',  ['uses'=>'UsersController@show']);

    Route::resource('cursos','CursosController', ['only' => ['show','index'] ]);

    Route::get('instructores/{id}/{alias?}',  ['uses'=>'InstructoresController@show']);

    Route::resource('instructores','InstructoresController', ['only' => ['show','index'] ]);

    Route::get('cursos/{id}/{alias?}',  ['uses'=>'CursosController@show']);

    Route::resource('foros','ForosController', ['only' => ['show','index'] ]);

    Route::get('foros/{id}/{alias?}',  ['uses'=>'ForosController@show']);

    Route::resource('mps','MPsController', ['only' => ['show','index'] ]);

    Route::get('mps/{id}',  ['uses'=>'MPsController@show']);

    Route::resource('comentarios','ComentariosController', ['only' => ['create','store','destroy'] ]);*/
});


