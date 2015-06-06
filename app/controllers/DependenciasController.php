<?php

class DependenciasController extends \BaseController {

	/**
	 * Display a listing of dependencias
	 *
	 * @return Response
	 */
	public function index()
	{

		return View::make('dependencias.index');
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
		$validator = Validator::make($data = Input::all(), Dependencia::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Dependencia::create($data);

		return Redirect::route('dependencias.index');
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
	 * Update the specified dependencia in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$dependencia = Dependencia::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Dependencia::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$dependencia->update($data);

		return Redirect::route('dependencias.index');
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

		return Redirect::route('dependencias.index');
	}

}
