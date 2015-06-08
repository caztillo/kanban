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
            {{ Form::open(array('action'=>'InscripcionesController@postSearch', 'method' => 'POST')) }}
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="filters">
                        <th style="width:5%"><input type="text" name="ano_fiscal" class="form-control" placeholder="Año Fiscal" disabled></th>
                        <th style="width:10%"><input type="text" name="dependencia" class="form-control" placeholder="Dependencia" disabled></th>
                        <th style="width:5%"><input type="text" name="clave_programa" class="form-control" placeholder="CVE. Prog." disabled></th>
                        <th style="width:10%"><input type="text" name="beneficiario" class="form-control" placeholder="Beneficiario" disabled></th>
                        <th style="width:10%"><input type="text" name="organizacion" class="form-control" placeholder="Organización" disabled></th>
                        <th style="width:10%"><input type="text" name="rfc" class="form-control" placeholder="RFC" disabled></th>
                        <th style="width:10%"><input type="text" name="curp" class="form-control" placeholder="CURP" disabled></th>
                        <th style="width:5%"><input type="text" name="estatus" class="form-control" placeholder="Estatus" disabled></th>
                        <th style="width:5%"><input type="text" name="inscripcion" class="form-control" placeholder="Fecha Inscripción" disabled></th>

                        {{ Form::close() }}
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('admin.script')
        @include('inscripciones.script')
    </script>
@stop