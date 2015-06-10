<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admin
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        return View::make("admin.dashboard");
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/login
	 *
	 * @return Response
	 */
	public function login()
	{
		//
        return View::make("admin.login");
	}

    public function logout()
    {
        //
        Sentry::logout();
        return View::make("admin.login");
    }

    public function loginValidacion()
    {
        $email = Input::get('email');
        $password = Input::get('password');


        try
        {
            // Login credentials
            $credentials = array(
                'email'    => $email,
                'password' => $password,
            );

            // Authenticate the user
            $user = Sentry::authenticate($credentials,  Input::has('recordarme'));

            Sentry::login($user, Input::has('recordarme'));

            return Redirect::intended('/');
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            //echo 'Login field is required.';
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Introduzca un e-mail.');
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            //echo 'Password field is required.';
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Introduzca una contraseña.');
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            //echo 'Wrong password, try again.';
            return Redirect::back()->with('message-type', 'danger')->with('message', 'E-mail o Contraseña incorrecta, intente de nuevo.');
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            //echo 'User was not found.';
            return Redirect::back()->with('message-type', 'danger')->with('message', 'El usuario no existe.');
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            //echo 'User is not activated.';
            return Redirect::back()->with('message-type', 'danger')->with('message', 'El usuario no está activado.');
        }

// The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            //echo 'User is suspended.';
            return Redirect::back()->with('message-type', 'danger')->with('message', 'El usuario está suspendido.');
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            //echo 'User is banned.';
            return Redirect::back()->with('message-type', 'danger')->with('message', 'El usuario está sancionado.');
        }
    }



    public function error_404()
    {
        //
        return View::make("error.404");
    }

    public function error_403()
    {
        //
        return View::make("error.403");
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /admin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}