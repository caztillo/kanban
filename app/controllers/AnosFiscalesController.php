<?php

class AnosFiscalesController extends \BaseController {

	/**
	 * Display a listing of anosfiscales
	 *
	 * @return Response
	 */
	public function index()
	{
		$anos_fiscales = AnoFiscal::orderBy('id_ano', 'desc')->get();
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
            'descripcion' => 'required|alpha_num_space|between:1,255',
            'fecha_inicio' => 'required|date|date_format:"Y-m-d"',
            'fecha_termino' => 'required|date|date_format:"Y-m-d"',
            'estado' => 'required|in:Activo,Inactivo',

        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'estado.integer' => 'Este campo es obligatorio.',
            'date' => 'Este campo debe ser una fecha válida',
            'date_format' => 'Utilice el formato Año-Mes-Día.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);


		if ($validator->fails())
		{
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}
        $data = Input::all();
        $data['creacion'] = date('Y-m-d H:i:s');
        AnoFiscal::create($data);

		return Redirect::route('anos_fiscales.index')->with('message-type', 'success')
            ->with('message', 'La información se ha guardado correctamente');
	}


	/**
	 * Show the form for editing the specified anosfiscale.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $ano_fiscal = AnoFiscal::find($id);

		return View::make('anos_fiscales.edit', compact('ano_fiscal'));
	}

	/**
	 * Update the specified anosfiscale in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$ano_fiscal = AnoFiscal::findOrFail($id);

        Input::merge(array_map('trim', Input::all()));

        $rules = [
            'descripcion' => 'required|alpha_num_space|between:1,255',
            'fecha_inicio' => 'required|date|date_format:"Y-m-d"',
            'fecha_termino' => 'required|date|date_format:"Y-m-d"',
            'estado' => 'required|in:Activo,Inactivo',

        ];

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'estado.integer' => 'Este campo es obligatorio.',
            'date' => 'Este campo debe ser una fecha válida',
            'date_format' => 'Utilice el formato Año-Mes-Día.',
            'between' => 'Este campo es obligatorio.',
            'in' => 'Este campo es obligatorio.',
            'alpha_num_space' => 'Utilice sólo caracteres del alfabeto, números y espacios.',
        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
		}

        $ano_fiscal->update($data);

		return Redirect::route('anos_fiscales.index')->with('message-type', 'success')
            ->with('message', 'La información se actualizó correctamente.');
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

		return Redirect::route('anos_fiscales.index')->with('message-type', 'success')
            ->with('message', 'El elemento se eliminó correctamente.');
	}

    /**
     * Display a listing of the resource.
     * GET /anos_fiscales/search
     *
     * @return Response
     */
    public function search()
    {

        $id_ano = Input::get('id_ano');
        $descripcion = Input::get('descripcion');
        $fecha_inicio = Input::get('fecha_inicio');
        $fecha_termino = Input::get('fecha_termino');
        $estado = Input::get('estado');
        $creacion = Input::get('creacion');

        if(!empty($id_ano) )
            $anos_fiscales = AnoFiscal::where('id_ano','=',$id_ano)->orderBy('id_ano', 'desc')->get();
        else
        {
            $query = AnoFiscal::select();
            if(!empty($descripcion))
            {
                $query = $query->where('descripcion', 'LIKE', "%{$descripcion}%");
            }


            if(!empty($fecha_inicio))
            {
                $query = $query->where('fecha_inicio', '=', $fecha_inicio);
            }

            if(!empty($fecha_termino))
            {
                $query = $query->where('fecha_termino', '>=', $fecha_termino);
            }

            if(!empty($estado))
            {
                $query = $query->where('estado', '=', $estado);
            }

            if(!empty($creacion))
            {
                $query = $query->whereRaw("DATE(creacion) = '".$creacion."'");
            }

            
            $anos_fiscales = $query->orderBy('id_ano', 'desc')->get();


        }

        if($anos_fiscales->isEmpty())
        {
            return Redirect::route('anos_fiscales.index')
                ->with('message-type', 'warning')
                ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
        }
        else
        {
            return View::make('anos_fiscales.index', compact('anos_fiscales'));

        }

    }

}
