<?php

class UsuariosController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
        $usuarios = User::orderBy('id', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
		return View::make('usuarios.index', compact('usuarios'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('usuarios.create');
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'nombre' => 'required|alpha_num_space|between:1,255',
            'num_empleado' => 'required|between:1,255',
            'correo' => 'required|email',
            'contrasena' => 'required|between:5,255',
            'estado' => 'required|in:Activo,Inactivo'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'estado.integer' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.',
            'email' => 'El correo debe estar formado de la siguiente manera: direccion@dominio.com'
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $data = Input::all();
        $data['creacion'] = date('Y-m-d H:i:s');
        User::create($data);

		return Redirect::route('usuarios.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
	}


	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		return View::make('usuarios.edit', compact('user'));
	}

	/**
	 * Update the specified depdencia in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$usuario = User::findOrFail($id);

        Input::merge(array_map('trim', Input::all()));

         $rules = [
            'nombre' => 'required|alpha_num_space|between:1,255',
            'num_empleado' => 'required|between:1,255',
            'correo' => 'required|email',
            'contrasena' => 'required|between:5,255',
            'estado' => 'required|in:Activo,Inactivo'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'estado.integer' => 'Este campo es obligatorio.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.',
            'email' => 'El correo debe estar formado de la siguiente manera: direccion@dominio.com'
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $usuario->update($data);

		return Redirect::route('usuarios.index')->with('message-type', 'success')
            ->with('message', 'La información se actualizó correctamente.');
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
		return Redirect::route('usuarios.index')->with('message-type', 'success')
		->with('message', 'El elemento se eliminó correctamente.');
	}

    /**
     * Display a listing of the resource.
     * GET /users/search
     *
     * @return Response
     */
    public function search()
    {
        $id_user = Input::get('id');
        $nombre = Input::get('nombre');
        $num_empleado = Input::get('num_empleado');
        $correo = Input::get('correo');
        $estado = Input::get('estado');
        $creacion = Input::get('creacion');

        if(!empty($id_user) )
            $users = User::where('id','=',$id_user)->simplePaginate(Config::get("constantes.elementos_pagina"));
        else
        {
            $query = User::select();
            if(!empty($nombre))
            {
                $query = $query->where('nombre', 'LIKE', "%{$nombre}%");
            }

            if(!empty($num_empleado))
            {
                $query = $query->where('num_empleado', '=', $num_empleado);
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

            $users = $query->orderBy('id','desc')->simplePaginate(Config::get("constantes.elementos_pagina"));

        }

        if($users->isEmpty())
        {
            return Redirect::route('usuarios.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('usuarios.index', compact('users'));
        }

    }


}
