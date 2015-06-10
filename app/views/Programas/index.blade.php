@extends('admin.menu')
@section("css")
    {{ HTML::style("css/custom.css") }}
@stop
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header colorbrand">Programas</h3>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('url' => 'programas/search/', 'method' => "GET")) }}
            <div class="panel panel-default filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                        {{ Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', array('type' => 'submit', 'class' => 'btn btn-info btn-sm', "style" => "display:none;"))}}
                        @if(Sentry::getUser()->hasAccess('programas.create'))
                            <a class="btn btn-primary btn-sm" href="{{url('programas/create')}}" role="button"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                        @endif

                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr class="filters">
                        <th style="width:1%"><input type="text" name="id_programa" class="form-control filtrar" placeholder="#" disabled></th>
                        <th style="width:10%"><input type="text" name="ano_fiscal" class="form-control filtrar" placeholder="Año fiscal" disabled></th>
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
                    @foreach($programas as $programa)
                        <tr>
                            <td>{{$programa->id_programa}}</td>
                            <td>{{$programa->ano->descripcion}}</td>
                            <td>{{$programa->dependencia->nombre}}</td>
                            <td>{{$programa->clave}}</td>
                            <td>{{$programa->estado}}</td>
                            <td>{{date("Y-m-d",strtotime($programa->creacion))}}</td>

                            <td>
                                @if(Sentry::getUser()->hasAccess('programas.update'))
                                    <a class="btn btn-success btn-xs" href="{{url('programas/'.$programa->id_programa . '/edit')}}" role="button"><span class="glyphicon glyphicon-pencil"></span></a>
                                @endif

                            </td>
                            <td>
                                @if(Sentry::getUser()->hasAccess('programas.delete'))
                                    {{ Form::open(array('url' => 'programas/' . $programa->id_programa)) }}
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
               {{ $programas->links() }}
              </ul>
            </nav>
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('admin.script')
        @include('programas.script')
    </script>
@stop