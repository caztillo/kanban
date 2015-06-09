@extends('admin.menu')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inscripción de Beneficiario a Organización</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('url' => 'beneficiarios_organizaciones/search/', 'method' => "GET")) }}
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}
                        <a class="btn btn-primary btn-sm" href="{{url('beneficiarios_organizaciones/create')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="filters">
                        <th style="width:1%"><input type="text" name="id_beneficiario_organizacion" class="form-control filtrar" placeholder="#" disabled></th>
                        <th style="width:10%"><input type="text" name="organizacion" class="form-control filtrar" placeholder="Organizacion" disabled></th>
                        <th style="width:10%"><input type="text" name="beneficiario" class="form-control filtrar" placeholder="Beneficiario" disabled></th>
                        <th style="width:10%"><input type="text" name="estado" class="form-control filtrar" placeholder="Estatus" disabled></th>
                        <th style="width:5%"><input type="text" name="inscripcion" class="form-control" placeholder="Inscripción" disabled></th>
                        <th style="width:1%"></th>
                        <th style="width:1%"></th>
                        {{ Form::close() }}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($beneficiarios_organizaciones as $beneficiario_organizacion)
                        <tr>
                            <td>{{$beneficiario_organizacion->id_beneficiario_organizacion}}</td>
                            <td>{{$beneficiario_organizacion->organizacion->nombre}}</td>
                            <td>{{$beneficiario_organizacion->beneficiario->nombre}}</td>
                            <td>{{$beneficiario_organizacion->estado}}</td>
                            <td>{{date("Y-m-d",strtotime($beneficiario_organizacion->inscripcion))}}</td>
                            <td> <a class="btn btn-success btn-xs" href="{{url('beneficiarios_organizaciones/'.$beneficiario_organizacion->id_beneficiario_organizacion . '/edit')}}" role="button"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td>
                                {{ Form::open(array('url' => 'beneficiarios_organizaciones/' . $beneficiario_organizacion->id_beneficiario_organizacion)) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::button('<span class="glyphicon glyphicon-remove"></span>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs'))}}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('admin.script')
        @include('beneficiarios_organizaciones.script')
    </script>
@stop