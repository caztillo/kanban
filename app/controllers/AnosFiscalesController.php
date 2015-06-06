<?php

class AnosFiscalesController extends \BaseController {

	/**
	 * Display a listing of anosfiscales
	 *
	 * @return Response
	 */
	public function index()
	{
		$anos_fiscales = AnoFiscal::all();
		return View::make('anos_fiscales.index', compact('anos_fiscales'));

	}

	/**
	 * Show the form for creating a new anosfiscale
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('anos_fiscales.create');
	}

	/**
	 * Store a newly created anosfiscale in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'descripcion' => 'required|alpha_space|between:1,255',
            'fecha_inicio' => 'required|date|date_format:"Y/m/d"',
            'fecha_termino' => 'required|date|date_format:"Y/m/d"',
            'estado' => 'required|in:Activo,Inactivo',

        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'estado.integer' => 'Este campo es obligatorio.',
            'date' => 'Este campo debe ser una fecha válida',
            'date_format' => 'Utilice el formato Año/Mes/Día.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.',
            'alpha_space' => 'Utilice sólo caracteres del alfabeto y espacios.',
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);


		if ($validator->fails())
		{
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}
        $data = Input::all();

        AnoFiscal::create($data);

		return Redirect::route('anos_fiscales.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
	}

	/**
	 * Display the specified anosfiscale.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$anosfiscale = AnoFiscal::findOrFail($id);

		return View::make('anos_fiscales.show', compact('anosfiscale'));
	}

	/**
	 * Show the form for editing the specified anosfiscale.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$anosfiscale = AnoFiscal::find($id);

		return View::make('anos_fiscales.edit', compact('anosfiscale'));
	}

	/**
	 * Update the specified anosfiscale in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$anosfiscale = AnoFiscal::findOrFail($id);

		$validator = Validator::make($data = Input::all(), AnoFiscal::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$anosfiscale->update($data);

		return Redirect::route('anos_fiscales.index');
	}

	/**
	 * Remove the specified anosfiscale from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		AnoFiscal::destroy($id);

		return Redirect::route('anos_fiscales.index');
	}

}
