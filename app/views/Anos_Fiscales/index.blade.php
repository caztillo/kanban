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
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
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
                            <th style="width:5%"><input type="text" name="estado" class="form-control" placeholder="Estado" disabled></th>
                            <th style="width:5%"><input type="text" name="creacion" class="form-control" placeholder="Creación" disabled></th>
                            <th style="width:1%"></th>
                            <th style="width:1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($anos_fiscales as $ano_fiscal)
                        <tr>
                            <td>{{$ano_fiscal->id_ano}}</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>06/06/2015</td>
                            <td>12/06/2015</td>
                            <td>Activo</td>
                            <td>01/05/2015</td>
                            <td><button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></td>
                            <td><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button></td>
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