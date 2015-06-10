@extends('admin.menu')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header colorbrand">Direcciones</h3>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('url' => 'direcciones/search/', 'method' => "GET")) }}
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}
                        <a class="btn btn-primary btn-sm" href="{{url('direcciones/create')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="filters">
                        <th style="width:1%"><input type="text" name="id_direccion" class="form-control filtrar" placeholder="#" disabled></th>
                        <th style="width:10%"><input type="text" name="nombre" class="form-control filtrar" placeholder="Nombre" disabled></th>
                        <th style="width:10%"><input type="text" name="dependencia" class="form-control filtrar" placeholder="Dependencia" disabled></th>
                        <th style="width:10%"><input type="text" name="clave" class="form-control filtrar" placeholder="Clave" disabled></th>
                        <th style="width:10%"><input type="text" name="estado" class="form-control filtrar" placeholder="Estatus" disabled></th>
                        <th style="width:5%"><input type="text" name="creacion" class="form-control" placeholder="Creación" disabled></th>
                        <th style="width:1%"></th>
                        <th style="width:1%"></th>
                        {{ Form::close() }}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($direcciones as $direccion)
                        <tr>
                            <td>{{$direccion->id_direccion}}</td>
                            <td>{{$direccion->nombre}}</td>
                            <td>{{$direccion->dependencia->nombre}}</td>
                            <td>{{$direccion->clave}}</td>
                            <td>{{$direccion->estado}}</td>
                            <td>{{date("Y-m-d",strtotime($direccion->creacion))}}</td>

                            <td> <a class="btn btn-success btn-xs" href="{{url('direcciones/'.$direccion->id_direccion . '/edit')}}" role="button"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td>
                                {{ Form::open(array('url' => 'direcciones/' . $direccion->id_direccion)) }}
                                {{ Form::hidden('_method', 'DELETE') }}
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
               {{ $direcciones->links() }}
              </ul>
            </nav>
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('admin.script')
        @include('direcciones.script')
    </script>
@stop