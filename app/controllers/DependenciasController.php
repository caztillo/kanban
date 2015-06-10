<?php

class DependenciasController extends \BaseController {

	/**
	 * Display a listing of dependencias
	 *
	 * @return Response
	 */
	public function index()
	{
        $dependencias = Dependencia::orderBy('id_dependencia', 'desc')->simplePaginate(5);
		return View::make('dependencias.index', compact('dependencias'));
	}

	/**
	 * Show the form for creating a new dependencia
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('dependencias.create');
	}

	/**
	 * Store a newly created dependencia in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'nombre' => 'required|alpha_num_space|between:1,255',
            'clave' => 'required|alpha_num_space|between:1,255',
            'direccion' => 'required|between:1,255',
            'estado' => 'required|in:Activo,Inactivo',
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'estado.integer' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.',
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $data = Input::all();
        $data['creacion'] = date('Y-m-d H:i:s');
        Dependencia::create($data);

		return Redirect::route('dependencias.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
	}


	/**
	 * Show the form for editing the specified dependencia.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$dependencia = Dependencia::find($id);

		return View::make('dependencias.edit', compact('dependencia'));
	}

	/**
	 * Update the specified depdencia in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$dependencia = Dependencia::findOrFail($id);

        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'nombre' => 'required|alpha_num_space|between:1,255',
            'clave' => 'required|alpha_num_space|between:1,255',
            'direccion' => 'required|between:1,255',
            'estado' => 'required|in:Activo,Inactivo',
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'estado.integer' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.',
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $dependencia->update($data);

		return Redirect::route('dependencias.index')->with('message-type', 'success')
            ->with('message', 'La información se actualizó correctamente.');
	}

	/**
	 * Remove the specified dependencia from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Dependencia::destroy($id);
		return Redirect::route('dependencias.index')->with('message-type', 'success')
		->with('message', 'El elemento se eliminó correctamente.');
	}

    /**
     * Display a listing of the resource.
     * GET /dependencias/search
     *
     * @return Response
     */
    public function search()
    {

        $id_dependencia = Input::get('id_dependencia');
        $nombre = Input::get('nombre');
        $clave = Input::get('clave');
        $direccion = Input::get('direccion');
        $estado = Input::get('estado');
        $creacion = Input::get('creacion');

        if(!empty($id_dependencia) )
            $dependencias = Dependencia::where('id_dependencia','=',$id_dependencia)->simplePaginate(Config::get("constantes.elementos_pagina"));
        else
        {
            $query = Dependencia::select();
            if(!empty($nombre))
            {
                $query = $query->where('nombre', 'LIKE', "%{$nombre}%");
            }

            if(!empty($clave))
            {
                $query = $query->where('clave', '=', $clave);
            }

            if(!empty($direccion))
            {
                $query = $query->where('direccion', 'LIKE', "%{$direccion}%");
            }

            if(!empty($estado))
            {
                $query = $query->where('estado', '=', $estado);
            }

            if(!empty($creacion))
            {
                $query = $query->whereRaw("DATE(creacion) = '".$creacion."'");
            }


            $dependencias = $query->orderBy('id_dependencia','desc')->simplePaginate(Config::get("constantes.elementos_pagina"));


        }

        if($dependencias->isEmpty())
        {
            return Redirect::route('dependencias.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('dependencias.index', compact('dependencias'));
        }

    }


}
