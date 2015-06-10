<?php

class BeneficiariosOrganizacionesController extends \BaseController {

    /**
     * Display a listing of beneficiarios_organizaciones
     *
     * @return Response
     */
    public function index()
    {
        $beneficiarios_organizaciones = BeneficiarioOrganizacion::orderBy('id_beneficiario_organizacion', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
    
        return View::make('beneficiarios_organizaciones.index', compact('beneficiarios_organizaciones'));
    }

    /**
     * Show the form for creating a new beneficiarios_organizaciones
     *
     * @return Response
     */
    public function create()
    {
        $beneficiarios = Beneficiario::orderBy('id_beneficiario', 'desc')->where('estado', '=', 'Activo')->lists('nombre','id_beneficiario');

        $organizaciones = Organizacion::orderBy('id_organizacion', 'desc')->where('estado', '=', 'Activo')->lists('nombre', 'id_organizacion');

        return View::make('beneficiarios_organizaciones.create', compact('beneficiarios','organizaciones'));
    }

    /**
     * Store a newly created beneficiarios_organizaciones in storage.
     *
     * @return Response
     */
    public function store()
    {
        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'comentarios' => 'max:10000',
            'id_beneficiario' => 'required|exists:beneficiario,id_beneficiario',
            'id_organizacion' => 'required|exists:organizacion,id_organizacion',
            'estado' => 'required|in:Activo,Inactivo'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'max' => 'Este campo puede contener hasta 10000 caracteres.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'estado.in' => 'Seleccione una opción.',
            'id_organizacion.exists' => 'Seleccione una organización.',
            'id_beneficiario.exists' => 'Seleccione un beneficiario.'
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);


        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }
        
        $data = Input::all();
        $data['inscripcion'] = date('Y-m-d H:i:s');
        BeneficiarioOrganizacion::create($data);

        return Redirect::route('beneficiarios_organizaciones.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
    }


    /**
     * Show the form for editing the specified beneficiarios_organizaciones.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $beneficiario_organizacion = BeneficiarioOrganizacion::find($id);
            
        $beneficiarios = Beneficiario::orderBy('id_beneficiario', 'desc')->where('estado', '=', 'Activo')->lists('nombre','id_beneficiario');

        $organizaciones = Organizacion::orderBy('id_organizacion', 'desc')->where('estado', '=', 'Activo')->lists('nombre', 'id_organizacion');

        return View::make('beneficiarios_organizaciones.edit', compact('beneficiario_organizacion', 'beneficiarios', 'organizaciones'));
    }

    /**
     * Update the specified beneficiarios_organizaciones in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $beneficiario_organizacion = BeneficiarioOrganizacion::findOrFail($id);

        Input::merge(array_map('trim', Input::all()));

         $rules = [
            'comentarios' => 'max:10000',
            'id_beneficiario' => 'required|exists:beneficiario,id_beneficiario',
            'id_organizacion' => 'required|exists:organizacion,id_organizacion',
            'estado' => 'required|in:Activo,Inactivo'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'max' => 'Este campo puede contener hasta 10000 caracteres.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'estado.in' => 'Seleccione una opción.',
            'id_organizacion.exists' => 'Seleccione una organización.',
            'id_beneficiario.exists' => 'Seleccione un beneficiario.'
        ];


        $validator = Validator::make($data = Input::all(), $rules, $messages);

        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }

        $beneficiario_organizacion->update($data);

        return Redirect::route('beneficiarios_organizaciones.index')->with('message-type', 'success')
            ->with('message', 'La información se actualizó correctamente.');
    }

    /**
     * Remove the specified beneficiarios_organizaciones from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        BeneficiarioOrganizacion::destroy($id);

        return Redirect::route('beneficiarios_organizaciones.index')->with('message-type', 'success')
            ->with('message', 'El elemento se eliminó correctamente.');
    }

    /**
     * Display a listing of the resource.
     * GET /beneficiarios_organizaciones/search
     *
     * @return Response
     */
    public function search()
    {
        $id_beneficiario_organizacion = Input::get('id_beneficiario_organizacion');
        $beneficiario = Input::get('beneficiario');
        $organizacion = Input::get('organizacion');
        $estado = Input::get('estado');
        $inscripcion = Input::get('inscripcion');


        if(!empty($id_beneficiario_organizacion) )
        {  
            $beneficiarios_organizaciones = BeneficiarioOrganizacion::where('id_beneficiario_organizacion','=',$id_beneficiario_organizacion)->orderBy('id_beneficiario_organizacion', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
        }
        else
        {
            $query = BeneficiarioOrganizacion::select();
            if(!empty($nombre))
            {  
                $query = $query->where('nombre', 'LIKE', "%{$nombre}%");
            }

            if(!empty($beneficiario))
            {
                $query = $query->join('beneficiario', function($join) use ($beneficiario)
                {
                    $join->on('beneficiario_organizacion.id_beneficiario', '=', 'beneficiario.id_beneficiario')
                        ->where('beneficiario.nombre', 'LIKE', "%{$beneficiario}%");
                });
            }

            if(!empty($organizacion))
            {
                $query = $query->join('organizacion', function($join) use ($organizacion)
                {
                    $join->on('beneficiario_organizacion.id_organizacion', '=', 'organizacion.id_organizacion')
                        ->where('organizacion.nombre', 'LIKE', "%{$organizacion}%");
                });
            }

            if(!empty($estado))
            {
                $query = $query->where('estado', '=', $estado);
            }

            if(!empty($inscripcion))
            {
               $query = $query->whereRaw("DATE(inscripcion) = '".$inscripcion."'");
            }

            $beneficiarios_organizaciones = $query->orderBy('id_beneficiario_organizacion', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));

        }

        if($beneficiarios_organizaciones->isEmpty())
        {
            return Redirect::route('beneficiarios_organizaciones.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('beneficiarios_organizaciones.index', compact('beneficiarios_organizaciones'));

        }

    }

}
