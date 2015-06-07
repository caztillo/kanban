@extends('admin.master')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Beneficiarios</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        <a class="btn btn-primary btn-sm" href="{{url('beneficiarios/create')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr class="filters">
                            <th style="width:1%"><input type="text" name="id_beneficiario" class="form-control filtrar" placeholder="#" disabled></th>
                            <th style="width:10%"><input type="text" name="nombre" class="form-control filtrar" placeholder="Nombre" disabled></th>
                            <th style="width:10%"><input type="text" name="direccion" class="form-control filtrar" placeholder="Dirección" disabled></th>
                            <th style="width:10%"><input type="text" name="codigo_postal" class="form-control filtrar" placeholder="Código Postal" disabled></th>
                            <th style="width:10%"><input type="text" name="telefono" class="form-control filtrar" placeholder="Teléfono" disabled></th>
                            <th style="width:10%"><input type="text" name="correo" class="form-control filtrar" placeholder="Correo" disabled></th>
                            <th style="width:10%"><input type="text" name="fecha_nacimiento" class="form-control filtrar" placeholder="Fecha de Nacimiento" disabled></th>
                            <th style="width:10%"><input type="text" name="pais_nacionalidad" class="form-control filtrar" placeholder="País de Nacionalidad" disabled></th>
                            <th style="width:10%"><input type="text" name="RFC" class="form-control filtrar" placeholder="RFC" disabled></th>
                            <th style="width:10%"><input type="text" name="CURP" class="form-control filtrar" placeholder="CURP" disabled></th>
                            <th style="width:10%"><input type="text" name="estado" class="form-control filtrar" placeholder="Estatus" disabled></th>
                            <th style="width:5%"><input type="text" name="creacion" class="form-control" placeholder="Creación" disabled></th>
                            <th style="width:1%"></th>
                            <th style="width:1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($beneficiarios as $beneficiario)
                        <tr>
                            <td>{{$beneficiario->id_beneficiario}}</td>
                            <td>{{$beneficiario->nombre}}</td>
                            <td>{{$beneficiario->direccion}}</td>
                            <td>{{$beneficiario->codigo_postal}}</td>
                            <td>{{$beneficiario->telefono}}</td>
                            <td>{{$beneficiario->correo}}</td>
                            <td>{{$beneficiario->fecha_nacimiento}}</td>
                            <td>{{$beneficiario->pais_nacionalidad}}</td>
                            <td>{{$beneficiario->RFC}}</td>
                            <td>{{$beneficiario->CURP}}</td>                    
                            <td>{{$beneficiario->estado}}</td>
                            <td>{{$beneficiario->creacion}}</td>
                           
                            <td> <a class="btn btn-success btn-xs" href="{{url('beneficiarios/'.$beneficiario->id_beneficiario . '/edit')}}" role="button"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td>
                                {{ Form::open(array('url' => 'beneficiarios/' . $beneficiario->id_beneficiario)) }}
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