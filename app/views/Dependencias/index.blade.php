@extends('admin.menu')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header colorbrand">Dependencias</h3>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('url' => 'dependencias/search/', 'method' => "GET")) }}
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}
                        @if(Sentry::getUser()->hasAccess('dependencias.create'))
                            <a class="btn btn-primary btn-sm" href="{{url('dependencias/create')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                        @endif

                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr class="filters">
                            <th style="width:1%"><input type="text" name="id_dependencia" class="form-control" placeholder="#" disabled></th>
                            <th style="width:10%"><input type="text" name="nombre" class="form-control" placeholder="Nombre" disabled></th>
                            <th style="width:10%"><input type="text" name="clave" class="form-control" placeholder="Clave" disabled></th>
                            <th style="width:10%"><input type="text" name="direccion" class="form-control" placeholder="Dirección" disabled></th>
                            <th style="width:10%"><input type="text" name="estado" class="form-control" placeholder="Estatus" disabled></th>
                            <th style="width:5%"><input type="text" name="creacion" class="form-control" placeholder="Creación" disabled></th>
                            <th style="width:1%"></th>
                            <th style="width:1%"></th>
                            {{ Form::close() }}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($dependencias as $dependencia)
                        <tr>
                            <td>{{$dependencia->id_dependencia}}</td>
                            <td>{{$dependencia->nombre}}</td>
                            <td>{{$dependencia->clave}}</td>
                            <td>{{$dependencia->direccion}}</td>
                            <td>{{$dependencia->estado}}</td>
                            <td>{{date("Y-m-d",strtotime($dependencia->creacion))}}</td>
                           
                            <td>
                                @if(Sentry::getUser()->hasAccess('dependencias.update'))
                                    <a class="btn btn-success btn-xs" href="{{url('dependencias/'.$dependencia->id_dependencia . '/edit')}}" role="button"><span class="glyphicon glyphicon-pencil"></span></a>
                                @endif

                            </td>
                            <td>
                                @if(Sentry::getUser()->hasAccess('dependencias.delete'))
                                    {{ Form::open(array('url' => 'dependencias/' . $dependencia->id_dependencia)) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::button('<span class="glyphicon glyphicon-remove"></span>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs'))}}
                                    {{ Form::close() }}
                                @endif

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
             <nav>
              <ul class="pager">
               {{ $dependencias->links() }}
              </ul>
            </nav>
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('admin.script')
        @include('dependencias.script')
    </script>
@stop