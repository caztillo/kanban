@extends('admin.menu')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Beneficiarios</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('url' => 'beneficiarios/search/', 'method' => "GET")) }}
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>

                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}

                        <a class="btn btn-primary btn-sm" href="{{url('beneficiarios/create')}}" role="button"> <span class="glyphicon glyphicon-plus"></span> Nuevo</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr class="filters">
                            <th style="width:2%"><input type="text" name="id_beneficiario" class="form-control filtrar" placeholder="#" disabled></th>
                            <th style="width:10%"><input type="text" name="nombre" class="form-control filtrar" placeholder="Nombre" disabled></th>
                            <th style="width:9%"><input type="text" name="RFC" class="form-control filtrar" placeholder="RFC" disabled></th>
                            <th style="width:8%"><input type="text" name="CURP" class="form-control filtrar" placeholder="CURP" disabled></th>
                            <th style="width:5%"><input type="text" name="estado" class="form-control filtrar" placeholder="Estatus" disabled></th>
                            <th style="width:6%"><input type="text" name="creacion" class="form-control" placeholder="Creación" disabled></th>
                            <th style="width:1%"></th>
                            <th style="width:1%"></th>
                            {{Form::close()}}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($beneficiarios as $beneficiario)
                        <tr>
                            <td>{{$beneficiario->id_beneficiario}}</td>
                            <td>{{$beneficiario->nombre}}</td>
                            <td>{{$beneficiario->RFC}}</td>
                            <td>{{$beneficiario->CURP}}</td>
                            <td>{{$beneficiario->estado}}</td>
                            <td>{{date("Y-m-d",strtotime($beneficiario->creacion))}}</td>
                            
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
        @include('beneficiarios.script')
    </script>
@stop