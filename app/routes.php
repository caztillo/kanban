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

Route::get('/', array('as' => 'inicio', 'uses' => 'InscripcionesController@getIndex'));
Route::resource('dependencias', 'DependenciasController',array('except' => array('show')));
Route::resource('anos_fiscales', 'AnosFiscalesController',array('except' => array('show')));
Route::resource('organizaciones', 'OrganizacionesController',array('except' => array('show')));
Route::resource('direcciones', 'DireccionesController',array('except' => array('show')));
Route::resource('beneficiarios', 'BeneficiariosController',array('except' => array('show')));
Route::resource('programas', 'ProgramasController',array('except' => array('show')));
Route::resource('beneficiarios_organizaciones', 'BeneficiariosOrganizacionesController',array('except' => array('show')));

Route::controller('inscripciones', 'InscripcionesController');

Route::get('/anos_fiscales/search', array('uses' => 'AnosFiscalesController@search'));
Route::get('/dependencias/search', array('uses' => 'DependenciasController@search'));
Route::get('/organizaciones/search', array('uses' => 'OrganizacionesController@search'));
Route::get('/direcciones/search', array('uses' => 'DireccionesController@search'));
Route::get('/beneficiarios/search', array('uses' => 'BeneficiariosController@search'));
Route::get('/programas/search', array('uses' => 'ProgramasController@search'));
Route::get('/beneficiarios_organizaciones/search', array('uses' => 'BeneficiariosOrganizacionesController@search'));


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

Route::get('/test', function()
{
    $benefiarios_programas = BeneficiarioPrograma::all();

    foreach ($benefiarios_programas as $benefiario_programa)
    {
        echo '<br>';
        echo 'id_beneficiario_programa: '.$benefiario_programa->id_beneficiario_programa;
        foreach($benefiario_programa->beneficiario->beneficiario_organizacion as $beneficiario_organizacion)
        {

            echo ' id_organizacion: '.$beneficiario_organizacion->organizacion->nombre;
        }

    }
    //Restricción WHERE en Cláusula JOIN
    /*$dependencia = 'Depd';
     $query = Direccion::select();

    $query = $query->join('dependencia', function($join) use ($dependencia)
    {
        $dependencia = 'Depd';
        $join->on('direccion.id_dependencia', '=', 'dependencia.id_dependencia')
            ->where('dependencia.nombre', 'LIKE', "%{$dependencia}%");
    });
    return $query->get(); */
});


