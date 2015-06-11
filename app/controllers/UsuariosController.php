<?php

class UsuariosController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('hasAccess:usuarios.view');
    }
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
        $this->beforeFilter('hasAccess:usuarios.create');

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
        $this->beforeFilter('hasAccess:usuarios.create');

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
        $this->beforeFilter('hasAccess:usuarios.update');
        try
        {
            $usuario = Sentry::findUserById($id);
            $grupos = $usuario->getGroups();
            foreach ($grupos as $grupo)
            {
                $grupo_usuario = $grupo->id;
            }

            $grupos_sentry = Sentry::findAllGroups();

            $grupos = array();
            foreach ($grupos_sentry as $grupo)
            {
                $grupos[$grupo->id] = $grupo->name;
            }

            //Checamos si el usuario logueado es admin

            $user = Sentry::getUser();
            $admin = false;
            $grupos_usuario_logueado = $user->getGroups();
            foreach ($grupos_usuario_logueado as $grupo)
            {
                if($grupo->name == "Administrador")
                {
                    $admin = true;
                }
            }

            return View::make('usuarios.edit', compact('usuario','grupos', 'grupo_usuario','admin'));
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
        $this->beforeFilter('hasAccess:usuarios.update');

		$usuario = User::findOrFail($id);
        $user = Sentry::getUser();
        Input::merge(array_map('trim', Input::all()));

        $admin = false;
        $grupos_usuario_logueado = $user->getGroups();
        foreach ($grupos_usuario_logueado as $grupo)
        {
            if($grupo->name == "Administrador" || $grupo->name == "Encargado de Dependencia")
            {
                $admin = true;
            }
        }

        $rules = [
            'first_name' => 'required|alpha_num_space|between:1,255',
            'last_name' => 'required|alpha_num_space|between:1,255',

        ];

        if($id == $user->id)
        {
            //$user es el usuario logueado con Snetry2
            if($admin)
            {
                $rules['num_empleado'] = 'required|between:1,255|unique:users,id,'.$user->id;
                $rules['id_grupo'] = 'required|exists:groups,id';
                $rules['estado'] = 'required|boolean';
            }

            $rules['email'] = 'required|email|unique:users,id,'.$user->id;
        }
        else
        {
            //$usuario es el usuario encontrado con eloquent
            if($admin)
            {
                $rules['num_empleado'] = 'required|between:1,255|unique:users,id,'.$usuario->id;
                $rules['id_grupo'] = 'required|exists:groups,id';
                $rules['estado'] = 'required|boolean';
            }

            $rules['email'] = 'required|email|unique:users,id,'.$usuario->id;

        }

        if(Input::has('password'))
        {
            $rules['password'] = ['required', 'confirmed', 'regex:/^(?=.*\d).{6,}$/'];
            $rules['password_confirmation'] = 'required|min:6';
        }





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

        if($id == $user->id)
        {
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            if($admin)
            {
                $user->activated = Input::get('estado');
                $user->num_empleado = Input::get('num_empleado');
            }


            $user->email = Input::get('email');

            if(Input::has('password'))
            {
                $user->password = Input::get('password');
            }

            if($admin)
            {
                DB::table('users_groups')->where('user_id', $user->id)->delete();

                $newGroup= Sentry::getGroupProvider()->findById(Input::get('id_grupo'));
                $user->addGroup($newGroup); // Add group 1 from user
            }


            $user->save();
        }
        else
        {
            $usuario->first_name = Input::get('first_name');
            $usuario->last_name = Input::get('last_name');
            if($admin)
            {
                $usuario->activated = Input::get('estado');
                $usuario->num_empleado = Input::get('num_empleado');
            }
            $usuario->email = Input::get('email');

            if(Input::has('password'))
            {
                $user->password = Input::get('password');
            }

            if($admin)
            {
                DB::table('users_groups')->where('user_id', $id)->delete();
                $newGroup= Sentry::getGroupProvider()->findById(Input::get('id_grupo'));
                $user = Sentry::findUserById($id);
                $user->addGroup($newGroup); // Add group 1 from user
                $user->save();
            }
            $usuario->save();
        }


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
        $this->beforeFilter('hasAccess:usuarios.delete');
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
        $id = Input::get('id');
        $rol = Input::get('rol');
        $nombre = Input::get('nombre');
        $num_empleado = Input::get('num_empleado');
        $correo = Input::get('correo');
        $estado = Input::get('estado');
        $creacion = Input::get('creacion');

        if(!empty($id) )
            $usuarios = Sentry::getUserProvider()->createModel()->join('users_groups', 'users.id', '=', 'users_groups.user_id')->join('groups', 'groups.id', '=', 'users_groups.group_id')->where('users.id',$id)->simplePaginate(Config::get("constantes.elementos_pagina"));
        else
        {
            $query = Sentry::getUserProvider()->createModel()->join('users_groups', 'users.id', '=', 'users_groups.user_id')->join('groups', 'groups.id', '=', 'users_groups.group_id');

            if(!empty($rol))
            {
                $query = $query->where('groups.name', 'LIKE', "%{$rol}%");
            }

            if(!empty($nombre))
            {
                $query = $query->where('first_name', 'LIKE', "%{$nombre}%")
                ->orWhere('last_name', 'LIKE', "%{$nombre}%");
            }

            if(!empty($num_empleado))
            {
                $query = $query->where('num_empleado', '=', $num_empleado);
            }

            if(!empty($correo))
            {
                $query = $query->where('email', 'LIKE', "%{$correo}%");
            }

            if(!empty($estado))
            {
                $estado = (strtolower($estado) == 'activo') ? 1 : 0;
                $query = $query->where('activated', '=', $estado);
            }

            if(!empty($creacion))
            {
                $query = $query->whereRaw("date_format(users.created_at, '%Y-%m-%d') = '".$creacion."'");
            }

            $usuarios = $query->orderBy('users.id','desc')->simplePaginate(Config::get("constantes.elementos_pagina"));

        }

        if($usuarios->isEmpty())
        {
            return Redirect::route('usuarios.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('usuarios.index', compact('usuarios'));
        }

    }


}
