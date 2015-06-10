<?php

class UsuariosController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
        //$usuarios = User::orderBy('id', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));

        $usuarios = Sentry::getUserProvider()->createModel()->join('users_groups', 'users.id', '=', 'users_groups.user_id')->orderBy('id', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));


		return View::make('usuarios.index', compact('usuarios'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
        $grupos_sentry = Sentry::findAllGroups();

        $grupos = array();
        foreach ($grupos_sentry as $grupo)
        {
           $grupos[$grupo->id] = $grupo->name;
        }

        return View::make('usuarios.create', compact('grupos'));
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
            'first_name' => 'required|alpha_num_space|between:1,255',
            'last_name' => 'required|alpha_num_space|between:1,255',
            'num_empleado' => 'required|between:1,255|unique:users',
            'id_grupo' => 'required|exists:groups,id',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', 'regex:/^(?=.*\d).{6,}$/'],
            'password_confirmation' => 'required|min:6',
            'estado' => 'required|boolean'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'num_empleado.unique' => 'El número de empleado ya está en uso. Utilice otro.',
            'email.unique' => 'El correo ya está en uso. Utilice otro.',
            'email' => 'El formato del correo electrónico es inválido.',
            'regex' => 'Utilice al menos un número en su contraseña.',
            'confirmed' => 'La contraseña de confirmación no es correcta.',
            'password_confirmation.min'    => 'La contraseña de confirmación debe de ser por lo menos :min caracteres de longitud.',
            'confirmed' => 'La contraseña de confirmación no es correcta.',
            'exists' => 'Seleccione un rol',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'between' => 'Este campo es obligatorio.',
            'boolean' => 'Este campo es obligatorio.',
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $id_grupo = Input::get('id_grupo');
        $estado = Input::get('estado');

        $date = new \DateTime;
        try
        {
            $user = Sentry::createUser(
                [
                    'num_empleado' => Input::get('num_empleado'),
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                    'activated' => $estado,
                    'activated_at' => $date,
                    'created_at' => $date,
                    'updated_at' => $date,

                ]
            );

            // Find the group using the group id
            $adminGroup = Sentry::findGroupById($id_grupo);

            // Assign the group to the user
            $user->addGroup($adminGroup);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            //echo 'Login field is required.';
            return Redirect::back()->with('message-type', 'danger')->with('message', 'El campo Login es requerido.')->withErrors($validator)->withInput();
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            //echo 'Password field is required.';

            return Redirect::back()->with('message-type', 'danger')->with('message', 'El campo Password es requerido.')->withErrors($validator)->withInput();
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            //echo 'User with this login already exists.';

            return Redirect::back()->with('message-type', 'danger')->with('message', 'El Usuario con este login ya existe.')->withErrors($validator)->withInput();
        }
        catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            //echo 'Group was not found.';

            return Redirect::back()->with('message-type', 'danger')->with('message', 'El Rol no existe.')->withErrors($validator)->withInput();
        }


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
        try
        {
            $usuario = Sentry::findUserById($id);
            $grupos = $usuario->getGroups();
            dd($grupos);

            return View::make('usuarios.edit', compact('usuario'));
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'El usuario no existe.');
        }


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
            'first_name' => 'required|alpha_num_space|between:1,255',
            'last_name' => 'required|alpha_num_space|between:1,255',
            'num_empleado' => 'required|between:1,255|unique:users',
            'id_grupo' => 'required|exists:groups,id',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', 'regex:/^(?=.*\d).{6,}$/'],
            'password_confirmation' => 'required|min:6',
            'estado' => 'required|boolean'
        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'num_empleado.unique' => 'El número de empleado ya está en uso. Utilice otro.',
            'email.unique' => 'El correo ya está en uso. Utilice otro.',
            'email' => 'El formato del correo electrónico es inválido.',
            'regex' => 'Utilice al menos un número en su contraseña.',
            'confirmed' => 'La contraseña de confirmación no es correcta.',
            'password_confirmation.min'    => 'La contraseña de confirmación debe de ser por lo menos :min caracteres de longitud.',
            'confirmed' => 'La contraseña de confirmación no es correcta.',
            'exists' => 'Seleccione un rol',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
            'between' => 'Este campo es obligatorio.',
            'boolean' => 'Este campo es obligatorio.',
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
