<?php

class InscripcionesController extends \BaseController {

    /**
     * Display a listing of inscripciones
     *
     * @return Response
     */
    public function getIndex()
    {
        $beneficiarios_programas = BeneficiarioPrograma::orderBy('id_beneficiario_programa', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
        return View::make('inscripciones.index_beneficiario_programa', compact('beneficiarios_programas'));
    }

    public function getIndexOrganizacion()
    {
        $organizaciones_programas = OrganizacionPrograma::orderBy('id_organizacion_programa', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina"));
        return View::make('inscripciones.index_organizacion_programa', compact('organizaciones_programas'));
    }
    public function getBuscar()
    {

        $tipo_busqueda = Input::get('tipo_busqueda');
        $ano_fiscal = Input::get('ano_fiscal');
        $dependencia = Input::get('dependencia');
        $clave_programa = Input::get('clave_programa');
        $beneficiario = Input::get('beneficiario');
        $organizacion = Input::get('organizacion');
        $rfc = Input::get('rfc');
        $curp = Input::get('curp');
        $finalidad = Input::get('finalidad');
        $inscripcion = Input::get('inscripcion');

        $query = (($tipo_busqueda == 2) ? OrganizacionPrograma::select() :  $query = BeneficiarioPrograma::select());


        if(!empty($ano_fiscal))
        {
            if($tipo_busqueda == 1)
            {
                // Buscamos en Beneficiario Programa

                $query = $query->join('programa', function($join)
                {
                    $join->on('programa.id_programa', '=', 'beneficiario_programa.id_programa');
                })->join('ano', function($join) use ($ano_fiscal)
                {
                    $join->on('ano.id_ano', '=', 'programa.id_ano')
                        ->where('ano.descripcion', 'LIKE', "%{$ano_fiscal}%");
                });
            }
            else
            {
                // Buscamos en Organización Programa

                $query = $query->join('programa', function($join)
                {
                    $join->on('programa.id_programa', '=', 'organizacion_programa.id_programa');
                })->join('ano', function($join) use ($ano_fiscal)
                {
                    $join->on('ano.id_ano', '=', 'programa.id_ano')
                        ->where('ano.descripcion', 'LIKE', "%{$ano_fiscal}%");
                });
            }

        }

        if(!empty($dependencia))
        {
            if($tipo_busqueda == 1)
            {
                // Buscamos en Beneficiario Programa

                $query = $query->join('programa', function($join)
                {
                    $join->on('programa.id_programa', '=', 'beneficiario_programa.id_programa');
                })->join('dependencia', function($join) use ($dependencia)
                {
                    $join->on('dependencia.id_dependencia', '=', 'programa.id_dependencia')
                        ->where('dependencia.nombre', 'LIKE', "%{$dependencia}%");
                });
            }
            else
            {
                // Buscamos en Organización Programa

                $query = $query->join('programa', function($join)
                {
                    $join->on('programa.id_programa', '=', 'organizacion_programa.id_programa');
                })->join('dependencia', function($join) use ($dependencia)
                {
                    $join->on('dependencia.id_dependencia', '=', 'programa.id_dependencia')
                        ->where('dependencia.nombre', 'LIKE', "%{$dependencia}%");
                });
            }

        }

        if(!empty($clave_programa))
        {
            if($tipo_busqueda == 1)
            {
                // Buscamos en Beneficiario Programa

                $query = $query->join('programa', function($join) use ($clave_programa)
                {
                    $join->on('programa.id_programa', '=', 'beneficiario_programa.id_programa')
                    ->where('programa.clave', 'LIKE', "%{$clave_programa}%");
                });
            }
            else
            {
                // Buscamos en Organización Programa

                $query = $query->join('programa', function($join) use ($clave_programa)
                {
                    $join->on('programa.id_programa', '=', 'organizacion_programa.id_programa')
                        ->where('programa.clave', 'LIKE', "%{$clave_programa}%");
                });
            }

        }

        if(!empty($beneficiario))
        {
            $query = $query->join('beneficiario', function($join) use ($beneficiario)
            {
                $join->on('beneficiario.id_beneficiario', '=', 'beneficiario_programa.id_beneficiario')
                    ->where('beneficiario.nombre', 'LIKE', "%{$beneficiario}%");
            });
        }

        if(!empty($organizacion))
        {
            if($tipo_busqueda == 1)
            {
                // Buscamos en Beneficiario Programa

                $query = $query->join('beneficiario_organizacion', function($join)
                {
                    $join->on('beneficiario_organizacion.id_beneficiario', '=', 'beneficiario_programa.id_beneficiario');

                })->join('organizacion', function($join) use ($organizacion)
                {
                    $join->on('organizacion.id_organizacion', '=', 'beneficiario_organizacion.id_organizacion')
                        ->where('organizacion.nombre', 'LIKE', "%{$organizacion}%");
                });
            }
            else
            {
                // Buscamos en Organización Programa

                $query = $query->join('organizacion', function($join) use ($organizacion)
                {
                    $join->on('organizacion.id_organizacion', '=', 'organizacion_programa.id_organizacion')
                        ->where('organizacion.nombre', 'LIKE', "%{$organizacion}%");

                });
            }
        }

        if(!empty($rfc))
        {
            if($tipo_busqueda == 1)
            {
                $query = $query->join('beneficiario', function($join) use ($rfc)
                {
                    $join->on('beneficiario.id_beneficiario', '=', 'beneficiario_programa.id_beneficiario')
                        ->where('beneficiario.RFC', 'LIKE', "%{$rfc}%");
                });
            }
            else
            {
                $query = $query->join('organizacion', function($join) use ($rfc)
                {
                    $join->on('organizacion.id_organizacion', '=', 'organizacion_programa.id_organizacion')
                        ->where('organizacion.RFC', 'LIKE', "%{$rfc}%");
                });
            }

        }

        if(!empty($curp))
        {
            $query = $query->join('beneficiario', function($join) use ($curp)
            {
                $join->on('beneficiario.id_beneficiario', '=', 'beneficiario_programa.id_beneficiario')
                    ->where('beneficiario.CURP', 'LIKE', "%{$curp}%");
            });
        }

        if(!empty($finalidad))
        {
            $query = $query->where('finalidad', '=', $finalidad);
        }

        if(!empty($inscripcion))
        {
            $query = $query->whereRaw("DATE(inscripcion) = '".$inscripcion."'");
        }

        $inscripciones = (($tipo_busqueda == 1) ? $query->orderBy('id_beneficiario_programa', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina")) : $query->orderBy('id_organizacion_programa', 'desc')->simplePaginate(Config::get("constantes.elementos_pagina")));




        if($inscripciones->isEmpty())
        {
            if($tipo_busqueda == 1)
            {
                return Redirect::action('InscripcionesController@getIndex')
                    ->with('message-type', 'warning')
                    ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
            }
            else
            {
                return Redirect::action('InscripcionesController@getIndexOrganizacion')
                    ->with('message-type', 'warning')
                    ->with('message', 'El criterio de búsqueda no regresó ningún resultado.');
            }

        }
        else
        {
            if($tipo_busqueda == 1)
            {
                $beneficiarios_programas = $inscripciones;
                return View::make('inscripciones.index_beneficiario_programa', compact('beneficiarios_programas'));
            }
            else
            {
                $organizaciones_programas = $inscripciones;
                return View::make('inscripciones.index_organizacion_programa', compact('organizaciones_programas'));
            }


        }

    }
    public function getAgregarInscripcion($tipo_programa)
    {
        if($tipo_programa == 1)
        {
            $beneficiarios = Beneficiario::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_beneficiario');

            $programas = Programa::orderBy('descripcion', 'asc')->where('estado', '=', 'Activo')->lists('descripcion','id_programa');

            $direcciones = Direccion::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_direccion');

            return View::make('inscripciones.agregar_beneficiario_programa', compact('beneficiarios', 'programas', 'direcciones'));
        }
        else
        {

            $organizaciones = Organizacion::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_organizacion');

            $programas = Programa::orderBy('descripcion', 'asc')->where('estado', '=', 'Activo')->lists('descripcion','id_programa');

            $direcciones = Direccion::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_direccion');

            return View::make('inscripciones.agregar_organizacion_programa', compact('organizaciones', 'programas', 'direcciones'));
        }

    }
    public function postAgregarInscripcion()
    {
        Input::merge(array_map('trim', Input::all()));
        $tipo_programa = Input::get('tipo_programa');


        if($tipo_programa == 1)
        {
            $rules = [
                'id_beneficiario' => 'required|exists:beneficiario,id_beneficiario',
                'id_programa' => 'required|exists:programa,id_programa',
                'id_direccion' => 'required|exists:direccion,id_direccion',
                'finalidad' => 'required:in:Cumplida,En Proceso',
                'comentarios' => 'max:99999'
            ];
        }
       else
       {
           $rules = [
               'id_organizacion' => 'required|exists:organizacion,id_organizacion',
               'id_programa' => 'required|exists:programa,id_programa',
               'id_direccion' => 'required|exists:direccion,id_direccion',
               'finalidad' => 'required:in:Cumplida,En Proceso',
               'comentarios' => 'max:99999'
           ];
       }


        $messages = [
            'required' => 'Este campo es obligatorio.',
            'exists' => 'Seleccione un elemento',
            'in' => 'Este campo es obligatorio.',
            'max' => 'Intente recortar su entrada'

        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }

        $data = Input::all();
        $data['inscripcion'] = date('Y-m-d H:i:s');
        if($tipo_programa == 1)
        {
            BeneficiarioPrograma::create($data);

        }
        else
        {
            OrganizacionPrograma::create($data);
        }

        if($tipo_programa == 1)
        {
            return Redirect::action('InscripcionesController@getIndex')->with('message-type', 'success')
                ->with('message', 'La información se ha guardado correctamente');
        }
        else
        {
            return Redirect::action('InscripcionesController@getIndexOrganizacion')->with('message-type', 'success')
                ->with('message', 'La información se ha guardado correctamente');
        }




    }
    public function getEditarInscripcion($id)
    {
        $tipo_programa = Input::get('tipo_programa');

        if($tipo_programa == 1)
        {
            $beneficiarios = Beneficiario::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_beneficiario');

            $programas = Programa::orderBy('descripcion', 'asc')->where('estado', '=', 'Activo')->lists('descripcion','id_programa');

            $direcciones = Direccion::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_direccion');

            $beneficiario_programa = BeneficiarioPrograma::find($id);


            return View::make('inscripciones.editar_beneficiario_programa', compact('beneficiario_programa', 'beneficiarios', 'programas', 'direcciones'));
        }
        else
        {
            $organizaciones = Organizacion::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_organizacion');

            $programas = Programa::orderBy('descripcion', 'asc')->where('estado', '=', 'Activo')->lists('descripcion','id_programa');

            $direcciones = Direccion::orderBy('nombre', 'asc')->where('estado', '=', 'Activo')->lists('nombre','id_direccion');

            $organizacion_programa = OrganizacionPrograma::find($id);


            return View::make('inscripciones.editar_organizacion_programa', compact('organizacion_programa', 'organizaciones', 'programas', 'direcciones'));
        }

    }
    public function postActualizarInscripcion($id)
    {
        $tipo_programa = Input::get('tipo_programa');
        if($tipo_programa == 1)
        {
            $beneficiario_programa = BeneficiarioPrograma::findOrFail($id);
            $rules = [
                'id_beneficiario' => 'required|exists:beneficiario,id_beneficiario',
                'id_programa' => 'required|exists:programa,id_programa',
                'id_direccion' => 'required|exists:direccion,id_direccion',
                'finalidad' => 'required:in:Cumplida,En Proceso',
                'comentarios' => 'max:99999'
            ];
        }
        else
        {
            $organizacion_programa = OrganizacionPrograma::findOrFail($id);
            $rules = [
                'id_organizacion' => 'required|exists:organizacion,id_organizacion',
                'id_programa' => 'required|exists:programa,id_programa',
                'id_direccion' => 'required|exists:direccion,id_direccion',
                'finalidad' => 'required:in:Cumplida,En Proceso',
                'comentarios' => 'max:99999'
            ];
        }


        Input::merge(array_map('trim', Input::all()));



        $messages = [
            'required' => 'Este campo es obligatorio.',
            'exists' => 'Seleccione un elemento',
            'in' => 'Este campo es obligatorio.',
            'max' => 'Intente recortar su entrada'

        ];

        $validator = Validator::make($data = Input::all(), $rules, $messages);

        if ($validator->fails())
        {
            return Redirect::back()->with('message-type', 'danger')->with('message', 'Algunos datos no han sido propiamente ingresados, favor de revisarlos.')->withErrors($validator)->withInput();
        }

        if($tipo_programa == 1)
        {
            $beneficiario_programa->update($data);
        }
        else
        {
            $organizacion_programa->update($data);
        }

        if($tipo_programa == 1)
        {
            return Redirect::action('InscripcionesController@getIndex')->with('message-type', 'success')
                ->with('message', 'La información se ha actualizó correctamente');
        }
        else
        {
            return Redirect::action('InscripcionesController@getIndexOrganizacion')->with('message-type', 'success')
                ->with('message', 'La información se ha actualizó correctamente');
        }

    }
    public function postBorrarInscripcion($id)
    {

        $tipo_programa = Input::get('tipo_programa');

        if($tipo_programa == 1)
        {
            BeneficiarioPrograma::destroy($id);
            return Redirect::action('InscripcionesController@getIndex')->with('message-type', 'success')
                ->with('message', 'El elemento se eliminó correctamente.');
        }
        else
        {
            OrganizacionPrograma::destroy($id);
            return Redirect::action('InscripcionesController@getIndexOrganizacion')->with('message-type', 'success')
                ->with('message', 'El elemento se eliminó correctamente.');
        }
    }





}
