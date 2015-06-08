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

    public function postSearch()
    {

    }



}
