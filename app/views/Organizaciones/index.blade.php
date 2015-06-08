@extends('admin.master')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Organizaciones</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        <a class="btn btn-primary btn-sm" href="{{url('organizaciones/create')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr class="filters">
                            <th style="width:2%"><input type="text" name="id_organizacion" class="form-control filtrar" placeholder="#" disabled></th>
                            <th style="width:10%"><input type="text" name="nombre" class="form-control filtrar" placeholder="Nombre" disabled></th>
                            <th style="width:10%"><input type="text" name="razon_social" class="form-control filtrar" placeholder="Razón Social" disabled></th>
                            <th style="width:10%"><input type="text" name="contacto" class="form-control filtrar" placeholder="Contacto" disabled></th>
                            <th style="width:10%"><input type="text" name="correo" class="form-control filtrar" placeholder="Correo" disabled></th>
                            <th style="width:10%"><input type="text" name="estado" class="form-control filtrar" placeholder="Estatus" disabled></th>
                            <th style="width:10%"><input type="text" name="creacion" class="form-control" placeholder="Creación" disabled></th>
                            <th style="width:1%"></th>
                            <th style="width:1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($organizaciones as $organizacion)
                        <tr>
                            <td>{{$organizacion->id_organizacion}}</td>
                            <td>{{$organizacion->nombre}}</td>
                            <td>{{$organizacion->razon_social}}</td>
                            <td>{{$organizacion->contacto}}</td>
                            <td>{{$organizacion->correo}}</td>
                            <td>{{$organizacion->estado}}</td>
                            <td>{{$organizacion->creacion}}</td>
                        
                            <td> <a class="btn btn-success btn-xs" href="{{url('organizaciones/'.$organizacion->id_organizacion . '/edit')}}" role="button"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td>
                                {{ Form::open(array('url' => 'organizaciones/' . $organizacion->id_organizacion)) }}
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
    </script>
@stop