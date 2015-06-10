@extends('admin.menu')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header colorbrand">Inscripción a Programas</h3>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('action'=>'InscripcionesController@getBuscar', 'method' => 'GET')) }}

            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>

                    <div class="pull-right col-md-12">
                        <label class="control-label" for="radios">Buscar en</label>
                        <label class="radio-inline" for="radios-0">
                            <input type="radio" name="tipo_busqueda"  value="1" >
                            Beneficiarios
                        </label>
                        <label class="radio-inline" for="radios-1">
                            <input type="radio" name="tipo_busqueda"  value="2" checked="checked">
                            Organizaciones
                        </label>
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>

                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}
                        @if(Sentry::getUser()->hasAccess('inscripciones.create'))
                            <a class="btn btn-primary btn-sm" href="{{url('inscripciones/agregar-inscripcion/1')}}" role="button"><span class="glyphicon glyphicon-plus"></span> Inscribir Beneficiario</a>
                            <a class="btn btn-info btn-sm" href="{{url('inscripciones/agregar-inscripcion/2')}}" role="button"><span class="glyphicon glyphicon-plus"></span> Inscribir Organización</a>
                        @endif




                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="filters">
                        <th style=""><input type="text" name="ano_fiscal" class="form-control" placeholder="Año Fiscal" disabled></th>
                        <th style=""><input type="text" name="dependencia" class="form-control" placeholder="Dependencia" disabled></th>
                        <th style=""><input type="text" name="clave_programa" class="form-control" placeholder="CVE. Prog." disabled></th>
                        <th style=""><input type="text" name="organizacion" class="form-control" placeholder="Organización" disabled></th>
                        <th style=""><input type="text" name="rfc" class="form-control" placeholder="RFC" disabled></th>
                        <th style=""><input type="text" name="finalidad" class="form-control" placeholder="Finalidad" disabled></th>
                        <th style=""><input type="text" name="inscripcion" class="form-control" placeholder="Inscripción" disabled></th>
                        <th style="width:1%"></th>
                        <th style="width:1%"></th>
                        {{ Form::close() }}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organizaciones_programas as $organizacion_programa)
                        <tr>
                            <td>
                                <a title="Dé clic para ver más información del año" href="{{url('anos_fiscales/'. $organizacion_programa->programa->ano->id_ano.'/edit')}}">{{$organizacion_programa->programa->ano->descripcion}}</a>
                            </td>
                            <td><a title="Dé clic para ver más información de la dependencia" href="{{url('dependencias/'. $organizacion_programa->programa->dependencia->id_dependencia.'/edit')}}">{{$organizacion_programa->programa->dependencia->nombre}}</a>
                            </td>
                            <td>
                                <a title="Dé clic para ver más información el programa" href="{{url('programas/'. $organizacion_programa->programa->id_programa.'/edit')}}">{{$organizacion_programa->programa->clave}}</a>
                            </td>
                            <td>
                                <a title="Dé clic para ver más información de la organización" href="{{url('organizaciones/'. $organizacion_programa->organizacion->id_organizacion.'/edit')}}">{{$organizacion_programa->organizacion->nombre}}</a>
                            </td>
                            <td>{{$organizacion_programa->organizacion->RFC}}</td>
                            <td>{{$organizacion_programa->finalidad}}</td>
                            <td>{{date("Y-m-d",strtotime($organizacion_programa->inscripcion))}}</td>
                            <td>
                                @if(Sentry::getUser()->hasAccess('inscripciones.update'))
                                    {{ Form::open(array('method' => "GET",'action' => array('InscripcionesController@getEditarInscripcion',$organizacion_programa->id_organizacion_programa))) }}
                                    {{ Form::hidden('tipo_programa', 2) }}
                                    {{ Form::button('<span class="glyphicon glyphicon-pencil"></span>', array('type' => 'submit', 'class' => 'btn btn-success btn-xs'))}}
                                    {{ Form::close() }}
                                @endif

                            </td>
                            <td>
                                @if(Sentry::getUser()->hasAccess('inscripciones.delete'))
                                    {{ Form::open(array('action' => array('InscripcionesController@postBorrarInscripcion', $organizacion_programa->id_organizacion_programa))) }}
                                    {{ Form::hidden('tipo_programa', 2) }}
                                    {{ Form::hidden('_method', 'POST') }}
                                    {{ Form::button('<span class="glyphicon glyphicon-remove"></span>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs'))}}
                                    {{ Form::close() }}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pager">
                    {{ $organizaciones_programas->links() }}
                </ul>
            </nav>
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('admin.script')
        @include('inscripciones.script')
    </script>
@stop