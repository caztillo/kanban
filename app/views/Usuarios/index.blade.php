@extends('admin.menu')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuarios</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('url' => 'usuarios/search/', 'method' => "GET")) }}
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}
                        <a class="btn btn-primary btn-sm" href="{{url('usuarios/create')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="filters">
                        <th style="width:1%"><input type="text" name="id" class="form-control" placeholder="#" disabled></th>
                        <th style="width:10%"><input type="text" name="rol" class="form-control" placeholder="Rol" disabled></th>
                        <th style="width:10%"><input type="text" name="nombre" class="form-control" placeholder="Nombre" disabled></th>
                        <th style="width:10%"><input type="text" name="num_empleado" class="form-control" placeholder="Número de empleado" disabled></th>
                        <th style="width:10%"><input type="text" name="correo" class="form-control" placeholder="Correo" disabled></th>
                        <th style="width:10%"><input type="text" name="estado" class="form-control" placeholder="Estatus" disabled></th>
                        <th style="width:7%"><input type="text" name="creacion" class="form-control" placeholder="Creación" disabled></th>
                        <th style="width:1%"></th>
                        <th style="width:1%"></th>
                        {{ Form::close() }}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->id}}</td>

                            @foreach($usuario->groups()->get() as $grupo)
                                <td>{{ $grupo->name}}</td>
                            @endforeach

                            <td>{{$usuario->first_name .' '.  $usuario->last_name}}</td>
                            <td>{{$usuario->num_empleado}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>{{(($usuario->activated == 1) ? 'Activo' : 'Inactivo')}}</td>
                            <td>{{date("Y-m-d",strtotime($usuario->created_at))}}</td>
                            <td> <a class="btn btn-success btn-xs" href="{{url('usuarios/'.$usuario->id . '/edit')}}" role="button"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td>
                                {{ Form::open(array('url' => 'usuarios/' . $usuario->id)) }}
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
               {{ $usuarios->links() }}
              </ul>
            </nav>
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('admin.script')
        @include('usuarios.script')
    </script>
@stop