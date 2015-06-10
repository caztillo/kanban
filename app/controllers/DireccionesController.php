<?php

class DireccionesController extends \BaseController {

    /**
     * Display a listing of direcciones
     *
     * @return Response
     */
    public function index()
    {
        $direcciones = Direccion::orderBy('id_direccion', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
        return View::make('direcciones.index', compact('direcciones'));
    }

    /**
     * Show the form for creating a new direcciones
     *
     * @return Response
     */
    public function create()
    {
        $dependencias = Dependencia::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_dependencia');

        return View::make('direcciones.create', compact('dependencias'));
    }

    /**
     * Store a newly created direcciones in storage.
     *
     * @return Response
     */
    public function store()
    {
        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'nombre' => 'required|alpha_num_space|between:1,255',
            'clave' => 'required|alpha_num_space|between:1,255',
            'estado' => 'required|in:Activo,Inactivo',
            'id_dependencia' => 'required|exists:dependencia,id_dependencia'

        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'estado.in' => 'Seleccione una opción',
            'id_dependencia.exists' => 'Seleccione una dependencia'
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);


        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }
        $data = Input::all();
        $data['creacion'] = date('Y-m-d H:i:s');
        Direccion::create($data);

        return Redirect::route('direcciones.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
    }


    /**
     * Show the form for editing the specified direcciones.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $direccion = Direccion::find($id);
        $dependencias = Dependencia::orderBy('nombre', 'asc')->lists('nombre','id_dependencia');
        return View::make('direcciones.edit', compact('direccion', 'dependencias'));
    }

    /**
     * Update the specified direcciones in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $direccion = Direccion::findOrFail($id);

        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'nombre' => 'required|alpha_num_space|between:1,255',
            'clave' => 'required|alpha_num_space|between:1,255',
            'estado' => 'required|in:Activo,Inactivo',
            'id_dependencia' => 'required|exists:dependencia,id_dependencia'

        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'estado.in' => 'Seleccione una opción',
            'id_dependencia.exists' => 'Seleccione una dependencia'
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }

        $direccion->update($data);

        return Redirect::route('direcciones.index')->with('message-type', 'success')
            ->with('message', 'La información se actualizó correctamente.');
    }

    /**
     * Remove the specified direcciones from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Direccion::destroy($id);

        return Redirect::route('direcciones.index')->with('message-type', 'success')
            ->with('message', 'El elemento se eliminó correctamente.');
    }

    /**
     * Display a listing of the resource.
     * GET /direcciones/search
     *
     * @return Response
     */
    public function search()
    {

        $id_direccion = Input::get('id_direccion');
        $nombre = Input::get('nombre');
        $dependencia = Input::get('dependencia');
        $clave = Input::get('clave');
        $estado = Input::get('estado');
        $creacion = Input::get('creacion');

        if(!empty($id_direccion) )
            $direcciones = Direccion::where('id_direccion','=',$id_direccion)->orderBy('id_direccion', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
        else
        {
            $query = Direccion::select();
            if(!empty($nombre))
            {
                $query = $query->where('nombre', 'LIKE', "%{$nombre}%");
            }

            if(!empty($dependencia))
            {
                $query = $query->join('dependencia', function($join) use ($dependencia)
                {
                   
                    $join->on('direccion.id_dependencia', '=', 'dependencia.id_dependencia')
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


            $direcciones = $query->orderBy('id_direccion', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));


        }

        if($direcciones->isEmpty())
        {
            return Redirect::route('direcciones.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('direcciones.index', compact('direcciones'));

        }

    }

}
