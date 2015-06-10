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

Route::when('*', 'csrf', array('post', 'put', 'delete'));

Route::get('/', array('before' => 'hasAccess:inscripciones.index', 'as' => 'inicio', 'uses' => 'InscripcionesController@getIndex'));
Route::resource('dependencias', 'DependenciasController',array('before' => 'hasAccess:dependencias.index','except' => array('show')));
Route::resource('anos_fiscales', 'AnosFiscalesController',array('before' => 'hasAccess:anos_fiscales.index','except' => array('show')));
Route::resource('organizaciones', 'OrganizacionesController',array('before' => 'hasAccess:organizaciones.index','except' => array('show')));
Route::resource('direcciones', 'DireccionesController',array('before' => 'hasAccess:direcciones.index','except' => array('show')));
Route::resource('beneficiarios', 'BeneficiariosController',array('before' => 'hasAccess:beneficiarios.index','except' => array('show')));
Route::resource('programas', 'ProgramasController',array('before' => 'hasAccess:programas.index','except' => array('show')));
Route::resource('beneficiarios_organizaciones', 'BeneficiariosOrganizacionesController',array('before' => 'hasAccess:beneficiarios_organizaciones.index','except' => array('show')));
Route::resource('usuarios', 'UsuariosController',array('before' => 'hasAccess:usuarios.index','except' => array('show')));
Route::controller('inscripciones', 'InscripcionesController');

Route::get('/anos_fiscales/search', array('before' => 'hasAccess:anos_fiscales.index','uses' => 'AnosFiscalesController@search'));
Route::get('/dependencias/search', array('before' => 'hasAccess:dependencias.index','uses' => 'DependenciasController@search'));
Route::get('/organizaciones/search', array('before' => 'hasAccess:organizaciones.index','uses' => 'OrganizacionesController@search'));
Route::get('/direcciones/search', array('before' => 'hasAccess:direcciones.index','uses' => 'DireccionesController@search'));
Route::get('/beneficiarios/search', array('before' => 'hasAccess:beneficiarios.index','uses' => 'BeneficiariosController@search'));
Route::get('/programas/search', array('before' => 'hasAccess:programas.index','uses' => 'ProgramasController@search'));
Route::get('/beneficiarios_organizaciones/search', array('before' => 'hasAccess:beneficiarios_organizaciones.index','uses' => 'BeneficiariosOrganizacionesController@search'));
Route::get('/usuarios/search', array('before' => 'hasAccess:usuarios.index','uses' => 'UsuariosController@search'));


View::composer(Paginator::getViewName(), function($view) {
    $queryString = array_except(Input::query(), Paginator::getPageName());
    $view->paginator->appends($queryString);
});

Route::get('/login', array('as' => 'login','uses' => 'AdminController@login'));
Route::get('/404', array('as' => '404','uses' => 'AdminController@error_404'));
Route::get('/403', array('as' => '403','uses' => 'AdminController@error_403'));
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

/*App::error(function(Exception $exception, $code)
{
    Log::error($exception,array('url'=>Request::url()));
    if (app()->environment() != 'local')
    {
    return Response::view('Error.404', array('pageTitle'=>'Oops, something went wrong'), 500);
    }
});*/
