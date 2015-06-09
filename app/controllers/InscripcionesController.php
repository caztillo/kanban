<?php

class InscripcionesController extends \BaseController {

    /**
     * Display a listing of inscripciones
     *
     * @return Response
     */
    public function getIndex()
    {
        $beneficiarios_programas = BeneficiarioPrograma::all();
        return View::make('inscripciones.index', compact('beneficiarios_programas'));
    }

    public function getSearch()
    {

    }

    public function getAgregarBeneficiarioPrograma()
    {
        $beneficiarios = Beneficiario::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_beneficiario');

        $programas = Programa::orderBy('descripcion', 'asc')->where('estado', '=', 'Activo')->lists('descripcion','id_programa');

        $direcciones = Direccion::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_direccion');

        return View::make('inscripciones.agregar_beneficiario_programa', compact('beneficiarios', 'programas', 'direcciones'));
    }

    public function postAgregarBeneficiarioPrograma()
    {
        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'id_beneficiario' => 'required|exists:beneficiario,id_beneficiario',
            'id_programa' => 'required|exists:programa,id_programa',
            'id_direccion' => 'required|exists:direccion,id_direccion',
            'finalidad_cumplida' => 'required:in:Si,No',
            'comentarios' => 'max:99999'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'exists' => 'Seleccione un elemento',
            'in' => 'Este campo es obligatorio.',
            'max' => 'Intente recortar su entrada'

        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }

        $data = Input::all();
        $data['inscripcion'] = date('Y-m-d H:i:s');
        BeneficiarioPrograma::create($data);

        return Redirect::action('InscripcionesController@getIndex')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
    }




}
