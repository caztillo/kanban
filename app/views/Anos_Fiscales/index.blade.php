@extends('admin.master')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Años Fiscales</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('url' => 'anos_fiscales/search/', 'method' => "GET")) }}
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}
                        <a class="btn btn-primary btn-sm" href="{{url('anos_fiscales/create')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr class="filters">

                            <th style="width:1%"><input type="text" name="id_ano" class="form-control filtrar" placeholder="#" disabled></th>
                            <th style="width:15%"><input type="text" name="descripcion" class="form-control filtrar" placeholder="Descripción" disabled></th>
                            <th style="width:5%"><input type="text" name="fecha_inicio" class="form-control" placeholder="Fecha de Inicio" disabled></th>
                            <th style="width:5%"><input type="text" name="fecha_termino" class="form-control" placeholder="Fecha Término" disabled></th>
                            <th style="width:5%"><input type="text" name="estado" class="form-control" placeholder="Estatus" disabled></th>
                            <th style="width:5%"><input type="text" name="creacion" class="form-control" placeholder="Creación" disabled></th>
                            <th style="width:1%"></th>
                            <th style="width:1%"></th>
                            {{ Form::close() }}
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($anos_fiscales as $ano_fiscal)
                        <tr>
                            <td>{{$ano_fiscal->id_ano}}</td>
                            <td>{{$ano_fiscal->descripcion}}</td>
                            <td>{{$ano_fiscal->fecha_inicio}}</td>
                            <td>{{$ano_fiscal->fecha_termino}}</td>
                            <td>{{$ano_fiscal->estado}}</td>
                            <td>{{date("Y-m-d",strtotime($ano_fiscal->creacion))}}</td>

                            <td> <a class="btn btn-success btn-xs" href="{{url('anos_fiscales/'.$ano_fiscal->id_ano . '/edit')}}" role="button"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td>
                                {{ Form::open(array('url' => 'anos_fiscales/' . $ano_fiscal->id_ano)) }}
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
        @include('anos_fiscales.script')
    </script>
@stop