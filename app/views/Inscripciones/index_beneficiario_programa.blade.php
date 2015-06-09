@extends('admin.menu')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inscripciones</h1>
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
                            <input type="radio" name="tipo_busqueda"  value="1" checked="checked">
                            Beneficiarios
                        </label>
                        <label class="radio-inline" for="radios-1">
                            <input type="radio" name="tipo_busqueda"  value="2">
                            Organizaciones
                        </label>
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>

                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}

                        <a class="btn btn-primary btn-sm" href="{{url('inscripciones/agregar-inscripcion/1')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Inscribir Nuevo Beneficiario</a>
                        <a class="btn btn-info btn-sm" href="{{url('inscripciones/agregar-inscripcion/2')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Inscribir Nueva Organización</a>




                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="filters">
                        <th style=""><input type="text" name="ano_fiscal" class="form-control" placeholder="Año Fiscal" disabled></th>
                        <th style=""><input type="text" name="dependencia" class="form-control" placeholder="Dependencia" disabled></th>
                        <th style=""><input type="text" name="clave_programa" class="form-control" placeholder="CVE. Prog." disabled></th>
                        <th style=""><input type="text" name="beneficiario" class="form-control" placeholder="Beneficiario" disabled></th>
                        <th style=""><input type="text" name="organizacion" class="form-control" placeholder="Organización" disabled></th>
                        <th style=""><input type="text" name="rfc" class="form-control" placeholder="RFC" disabled></th>
                        <th style=""><input type="text" name="curp" class="form-control" placeholder="CURP" disabled></th>
                        <th style=""><input type="text" name="finalidad" class="form-control" placeholder="Finalidad" disabled></th>
                        <th style=""><input type="text" name="inscripcion" class="form-control" placeholder="Inscripción" disabled></th>
                        <th style="width:1%"></th>
                        <th style="width:1%"></th>
                        {{ Form::close() }}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($beneficiarios_programas as $beneficiario_programa)
                        <tr>
                            <td>{{$beneficiario_programa->programa->ano->descripcion}}</td>
                            <td>{{$beneficiario_programa->programa->dependencia->nombre}}</td>
                            <td>{{$beneficiario_programa->programa->clave}}</td>
                            <td>{{$beneficiario_programa->beneficiario->nombre}}</td>

                                @foreach($beneficiario_programa->beneficiario->beneficiario_organizacion as $beneficiario_organizacion)
                                <td>
                                    {{$beneficiario_organizacion->organizacion->nombre}}
                                </td>
                                @endforeach

                            <td>{{$beneficiario_programa->beneficiario->RFC}}</td>
                            <td>{{$beneficiario_programa->beneficiario->CURP}}</td>
                            <td>{{$beneficiario_programa->finalidad}}</td>
                            <td>{{date("Y-m-d",strtotime($beneficiario_programa->inscripcion))}}</td>
                            <td>
                                {{ Form::open(array('method' => "GET",'action' => array('InscripcionesController@getEditarInscripcion',$beneficiario_programa->id_beneficiario_programa))) }}
                                {{ Form::hidden('tipo_programa', 1) }}
                                {{ Form::button('<span class="glyphicon glyphicon-pencil"></span>', array('type' => 'submit', 'class' => 'btn btn-success btn-xs'))}}
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(array('action' => array('InscripcionesController@postBorrarInscripcion', $beneficiario_programa->id_beneficiario_programa))) }}
                                {{ Form::hidden('tipo_programa', 1) }}
                                {{ Form::hidden('_method', 'POST') }}
                                {{ Form::button('<span class="glyphicon glyphicon-remove"></span>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs'))}}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pager">
                    {{ $beneficiarios_programas->links() }}
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