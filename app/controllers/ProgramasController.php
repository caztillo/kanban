<?php

class ProgramasController extends \BaseController {

    /**
     * Display a listing of programas
     *
     * @return Response
     */
    public function index()
    {
        $programas = Programa::orderBy('id_programa', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina")); 


        return View::make('programas.index', compact('programas'));
    }

    /**
     * Show the form for creating a new programas
     *
     * @return Response
     */
    public function create()
    {
        $anos_fiscales = AnoFiscal::orderBy('descripcion', 'asc')->where('estado', '=', 'Activo')->lists('descripcion','id_ano');

        $dependencias = Dependencia::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_dependencia');

        return View::make('programas.create', compact('anos_fiscales','dependencias'));
    }

    /**
     * Store a newly created programas in storage.
     *
     * @return Response
     */
    public function store()
    {
        Input::merge(array_map('trim', Input::all()));

       $rules = [
            'id_dependencia' => 'required|exists:dependencia,id_dependencia',
            'id_ano' => 'required|exists:ano,id_ano',
            'clave' => 'required|alpha_num|between:1,255',
            'descripcion' => 'required|alpha_num_space|between:1,255',
            'convocatoria' => 'max:1000',
            'estado' => 'required|in:Activo,Inactivo'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'convocatoria.max' => 'La URL puede tener hasta 1000 caracteres de longitud.',
            'alpha_num' => 'Utilice sólo caracteres del alfabeto y numeros',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'id_dependencia.exists' => 'Seleccione una dependencia',
            'id_ano.exists' => 'Selecciona un año fiscal',
            'estado.in' => 'Seleccione una opción'
        
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);


        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }
        $data = Input::all();
        $data['creacion'] = date('Y-m-d H:i:s');
        Programa::create($data);

        return Redirect::route('programas.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
    }


    /**
     * Show the form for editing the specified programas.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $programa = Programa::find($id);
        $anos_fiscales = AnoFiscal::orderBy('descripcion', 'asc')->where('estado', '=', 'Activo')->lists('descripcion','id_ano');
        $dependencias = Dependencia::orderBy('nombre', 'asc')->lists('nombre','id_dependencia');
        return View::make('programas.edit', compact('programa', 'dependencias','anos_fiscales'));
    }

    /**
     * Update the specified programas in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $programa = Programa::findOrFail($id);

        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'id_dependencia' => 'required|exists:dependencia,id_dependencia',
            'id_ano' => 'required|exists:ano,id_ano',
            'clave' => 'required|alpha_num|between:1,255',
            'descripcion' => 'required|alpha_num_space|between:1,255',
            'convocatoria' => 'max:1000',
            'estado' => 'required|in:Activo,Inactivo'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'convocatoria.max' => 'La URL puede tener hasta 1000 caracteres de longitud.',
            'alpha_num' => 'Utilice sólo caracteres del alfabeto y numeros',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'id_dependencia.exists' => 'Seleccione una dependencia',
            'id_ano.exists' => 'Selecciona un año fiscal',
            'estado.in' => 'Seleccione una opción'
        
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }

        $programa->update($data);

        return Redirect::route('programas.index')->with('message-type', 'success')
            ->with('message', 'La información se actualizó correctamente.');
    }

    /**
     * Remove the specified programas from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Programa::destroy($id);

        return Redirect::route('programas.index')->with('message-type', 'success')
            ->with('message', 'El elemento se eliminó correctamente.');
    }

    /**
     * Display a listing of the resource.
     * GET /programas/search
     *
     * @return Response
     */
    public function search()
    {

        $id_programa = Input::get('id_programa');
        $nombre = Input::get('nombre');
        $dependencia = Input::get('dependencia');
        $clave = Input::get('clave');
        $estado = Input::get('estado');
        $creacion = Input::get('creacion');

        if(!empty($id_programa) )
            $programas = Programa::where('id_programa','=',$id_programa)->orderBy('id_programa', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
        else
        {
            $query = Programa::select();
            if(!empty($nombre))
            {
                $query = $query->where('nombre', 'LIKE', "%{$nombre}%");
            }

            if(!empty($dependencia))
            {
                $query = $query->join('dependencia', function($join) use ($dependencia)
                {
                   
                    $join->on('programa.id_dependencia', '=', 'dependencia.id_dependencia')
                        ->where('dependencia.nombre', 'LIKE', "%{$dependencia}%");
                });
            }

            if(!empty($clave))
            {
                $query = $query->where('clave', 'LIKE', "%{$clave}%");
            }

            if(!empty($estado))
            {
                $query = $query->where('estado', '=', $estado);
            }

            if(!empty($creacion))
            {
               $query = $query->whereRaw("DATE(creacion) = '".$creacion."'");
            }


            $programas = $query->orderBy('id_programa', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));


        }

        if($programas->isEmpty())
        {
            return Redirect::route('programas.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('programas.index', compact('programas'));

        }

    }

}
