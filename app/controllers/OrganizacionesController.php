<?php

class OrganizacionesController extends \BaseController {

	/**
	 * Display a listing of organizaciones
	 *
	 * @return Response
	 */
	public function index()
	{
		$organizaciones = Organizacion::orderBy('id_organizacion', 'desc')->get();
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
            'nombre' => 'required|between:1,255',
            'razon_social' => 'required|between:1,255',
            'codigo_postal' => 'required|digits:5',
            'direccion' => 'required|between:1,255',
            'contacto' => 'required|alpha_space|between:1,255',
            'telefono' => 'required|required|regex:/^[0-9]{10,20}$/',
            'correo' => 'required|email',
            'estado' => 'required|in:Activo,Vetado',
            'RFC' => array('required','regex:/^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/'),
           
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
             'RFC.regex' => 'Ingresa un RFC válido.',
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $data = Input::all();
        $data['creacion'] = date('Y-m-d H:i:s');
        Organizacion::create($data);

		return Redirect::route('organizaciones.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
	}

	/**
	 * Display the specified organizacion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$organizacion = Organizacion::findOrFail($id);

		return View::make('organizaciones.show', compact('organizacion'));
	}

	/**
	 * Show the form for editing the specified organizacion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$organizacion = Organizacion::find($id);

		return View::make('organizaciones.edit', compact('organizacion'));
	}

	/**
	 * Update the specified organizaciones in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$organizacion = Organizacion::findOrFail($id);

        Input::merge(array_map('trim', Input::all()));

         $rules = [
            'nombre' => 'required|between:1,255',
            'razon_social' => 'required|between:1,255',
            'codigo_postal' => 'required|digits:5',
            'direccion' => 'required|between:1,255',
            'contacto' => 'required|alpha_space|between:1,255',
            'telefono' => 'required|required|regex:/^[0-9]{10,20}$/',
            'correo' => 'required|email',
            'estado' => 'required|in:Activo,Vetado',
            'RFC' => array('required','regex:/^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/'),
           
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
             'RFC.regex' => 'Ingresa un RFC válido.',
        ];


        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $organizacion->update($data);

		return Redirect::route('organizaciones.index')->with('message-type', 'success')
            ->with('message', 'La información se actualizó correctamente.');
	}

	/**
	 * Remove the specified organizacion from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Organizacion::destroy($id);
		return Redirect::route('organizaciones.index')->with('message-type', 'success')
		->with('message', 'El elemento se eliminó correctamente.');
	}

	/**
     * Display a listing of the resource.
     * GET /organizaciones/search
     *
     * @return Response
     */
    public function search()
    {

        $id_organizacion = Input::get('id_organizacion');
        $nombre = Input::get('nombre');
        $razon_social = Input::get('razon_social');
        $direccion = Input::get('direccion');
        $codigo_postal = Input::get('codigo_postal');
        $contacto = Input::get('contacto');
        $telefono = Input::get('telefono');
        $correo = Input::get('correo');
        $RFC = Input::get('RFC');
        $estado = Input::get('estado');
        $creacion = Input::get('creacion');

        if(!empty($id_organizacion) )
            $organizaciones = Organizacion::where('id_organizacion','=',$id_organizacion)->orderBy('id_organizacion', 'desc')->get();
        else
        {
            $query = Organizacion::select();
            if(!empty($nombre))
            {
                $query = $query->where('nombre', 'LIKE', "%{$nombre}%");
            }

            if(!empty($razon_social))
            {
                $query = $query->where('razon_social', 'LIKE', "%{$razon_social}%");
            }

            if(!empty($direccion))
            {
                $query = $query->where('direccion', 'LIKE', "%{$direccion}%");
            }

            if(!empty($codigo_postal))
            {
                $query = $query->where('codigo_postal', '=', "%{$codigo_postal}%");
            }

            if(!empty($contacto))
            {
                $query = $query->where('contacto', 'LIKE', "%{$contacto}%");
            }

            if(!empty($RFC))
            {
                $query = $query->where('RFC', 'LIKE', "%{$RFC}%");
            }

            if(!empty($telefono))
            {
                $query = $query->where('direccion', '=', "%{$direccion}%");
            }

            if(!empty($correo))
            {
                $query = $query->where('correo', 'LIKE', "%{$correo}%");
            }

            if(!empty($estado))
            {
                $query = $query->where('estado', '=', $estado);
            }

            if(!empty($creacion))
            {
                 $query = $query->whereRaw("DATE(creacion) = '".$creacion."'");
            }

            $organizaciones = $query->orderBy('id_organizacion', 'desc')->get();

        }

        if($organizaciones->isEmpty())
        {
            return Redirect::route('organizaciones.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('organizaciones.index', compact('organizaciones'));

        }

    }

}
