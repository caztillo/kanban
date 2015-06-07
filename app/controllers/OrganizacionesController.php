<?php

class OrganizacionesController extends \BaseController {

	/**
	 * Display a listing of organizaciones
	 *
	 * @return Response
	 */
	public function index()
	{
		$organizaciones = Organizacion::all();
		return View::make('organizaciones.index', compact('organizaciones'));
	}

	/**
	 * Show the form for creating a new organizacion
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('organizaciones.create');
	}

	/**
	 * Store a newly created organizacion in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'nombre' => 'required|alpha_num_space|between:1,255',
            'razon_social' => 'required|alpha_space|between:1,255',
            'direccion' => 'required|digits:5',
            'codigo_postal' => 'required|alpha_num_space|between:1,255',
            'contacto' => 'required|alpha_space|between:1,255',
            'telefono' => 'required|required|regex:/^[0-9]{10,20}$/',
            'correo' => 'required|email',
            'estado' => 'required|in:Activo,Inactivo',
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'alpha_space' => 'Utilice sólo caracteres del alfabeto y espacios.',
            'codigo_postal.digits' => 'El código postal debe estar formado por 5 caracteres numéricos sin espacios.',
            'estado.integer' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'telefono.regex' => 'El formato ingresado no es válido',
            'email' => 'El correo debe estar formado de la siguiente manera: direccion@dominio.com',
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
	 * Display the specified dependencia.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$dependencia = Dependencia::findOrFail($id);

		return View::make('dependencias.show', compact('dependencia'));
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
            'direccion' => 'required|alpha_num_space|between:1,255',
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

}
