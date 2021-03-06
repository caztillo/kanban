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

Route::get('/login', array('as' => 'login','uses' => 'AdminController@login'));
Route::get('/logout', array('as' => 'logout','uses' => 'AdminController@logout'));
Route::post('/login-validacion', array('uses' => 'AdminController@loginValidacion'));
Route::get('/404', array('as' => '404','uses' => 'AdminController@error_404'));
Route::get('/403', array('as' => '403','uses' => 'AdminController@error_403'));

Route::group(['before' => 'auth'], function()
{
    Route::get('/', array('as' => 'inicio', 'uses' => 'InscripcionesController@getIndex'));
    Route::resource('dependencias', 'DependenciasController',array('except' => array('show')));
    Route::resource('anos_fiscales', 'AnosFiscalesController',array('except' => array('show')));
    Route::resource('organizaciones', 'OrganizacionesController',array('except' => array('show')));
    Route::resource('direcciones', 'DireccionesController',array('except' => array('show')));
    Route::resource('beneficiarios', 'BeneficiariosController',array('except' => array('show')));
    Route::resource('programas', 'ProgramasController',array('except' => array('show')));
    Route::resource('beneficiarios_organizaciones', 'BeneficiariosOrganizacionesController',array('except' => array('show')));
    Route::resource('usuarios', 'UsuariosController',array('except' => array('show')));
    Route::controller('inscripciones', 'InscripcionesController');

    Route::get('/anos_fiscales/search', array('uses' => 'AnosFiscalesController@search'));
    Route::get('/dependencias/search', array('uses' => 'DependenciasController@search'));
    Route::get('/organizaciones/search', array('uses' => 'OrganizacionesController@search'));
    Route::get('/direcciones/search', array('uses' => 'DireccionesController@search'));
    Route::get('/beneficiarios/search', array('uses' => 'BeneficiariosController@search'));
    Route::get('/programas/search', array('uses' => 'ProgramasController@search'));
    Route::get('/beneficiarios_organizaciones/search', array('uses' => 'BeneficiariosOrganizacionesController@search'));
    Route::get('/usuarios/search', array('uses' => 'UsuariosController@search'));

});

View::composer(Paginator::getViewName(), function($view) {
    $queryString = array_except(Input::query(), Paginator::getPageName());
    $view->paginator->appends($queryString);
});

Route::get('/test', function()
{

    /*$beneficiarios_programas = BeneficiarioPrograma::orderBy('id_beneficiario_programa', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));*/

    $beneficiarios_programas = DB::select(DB::raw('SELECT a.id_beneficiario_programa, c.descripcion AS ano_fiscal, d.nombre AS dependencia, b.clave AS programa, e.nombre AS beneficiario, COALESCE(g.nombre,"Sin Organización") as organizacion, e.RFC, e.CURP, a.finalidad, a.inscripcion FROM beneficiario_programa a JOIN beneficiario e ON a.id_beneficiario = e.id_beneficiario JOIN programa b ON a.id_programa = b.id_programa LEFT JOIN beneficiario_organizacion f ON a.id_beneficiario = f.id_beneficiario JOIN ano c ON b.id_ano = c.id_ano JOIN dependencia d ON b.id_dependencia = b.id_dependencia LEFT JOIN organizacion g ON f.id_organizacion = g.id_organizacion GROUP BY a.id_beneficiario_programa ORDER BY a.id_beneficiario_programa DESC'));


    $pageNumber = (isset($_GET['page'])) ? $_GET['page'] : 1;

    $slice = array_slice($beneficiarios_programas, Config::get("constantes.elementos_pagina") * ($pageNumber - 1), Config::get("constantes.elementos_pagina"));
    $beneficiarios_programas = Paginator::make($slice, count($beneficiarios_programas), Config::get("constantes.elementos_pagina"));

    foreach ($beneficiarios_programas as $beneficiarios_programa)
    {
        echo $beneficiarios_programa->id_beneficiario_programa;
    }


    /*$benefiarios_programas = BeneficiarioPrograma::all();

    foreach ($benefiarios_programas as $benefiario_programa)
    {
        echo '<br>';
        echo 'id_beneficiario_programa: '.$benefiario_programa->id_beneficiario_programa;
        foreach($benefiario_programa->beneficiario->beneficiario_organizacion as $beneficiario_organizacion)
        {

            echo ' id_organizacion: '.$beneficiario_organizacion->organizacion->nombre;
        }

    }*/
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

App::error(function(Exception $exception, $code)
{
    Log::error($exception,array('url'=>Request::url()));
    if (app()->environment() != 'local')
    {
    return Response::view('Error.404', array('pageTitle'=>'Oops, something went wrong'), 500);
    }
});
