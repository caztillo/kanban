<?php

class InscripcionesController extends \BaseController {

    /**
     * Display a listing of inscripciones
     *
     * @return Response
     */
    public function getIndex()
    {
        return View::make('inscripciones.index');
    }

    public function getSearch()
    {

    }

    public function getAgregarBeneficiarioPrograma()
    {
        $dependencias = Dependencia::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_dependencia');
        return View::make('direcciones.create', compact('dependencias'));
    }



}
