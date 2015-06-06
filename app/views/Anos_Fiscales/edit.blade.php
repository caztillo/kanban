@extends('admin.master')
@section("contenido")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Años Fiscales</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::model($ano_fiscal, array('route' => array('anos_fiscales.update', $ano_fiscal->id_ano), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
            <fieldset>

                <!-- Form Name -->
                <legend>Editar</legend>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('descripcion')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="descripcion">Descripción</label>
                    <div class="col-md-6">
                        {{ Form::text('descripcion', $ano_fiscal->descripcion, ['class' => 'form-control', 'placeholder' => 'Ingrese una descripción', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('descripcion')) ? $error : '' }}</span>
                    </div>
                </div>


                <!-- Text input-->
                <div class="form-group has-feedback {{ ($error = $errors->first('fecha_inicio')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="fecha_inicio">Fecha de inicio</label>
                    <div class="col-md-4">
                        {{ Form::text('fecha_inicio', date("Y-m-d",strtotime($ano_fiscal->fecha_inicio)), ['class' => 'form-control', 'placeholder' => 'Dé clic para seleccionar una fecha'] )}}
                        <span class="help-block">{{ ($error = $errors->first('fecha_inicio')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group has-feedback {{ ($error = $errors->first('fecha_termino')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="fecha_termino">Fecha de término</label>
                    <div class="col-md-4">
                        {{ Form::text('fecha_termino', date("Y-m-d",strtotime($ano_fiscal->fecha_termino)), ['class' => 'form-control', 'placeholder' => 'Dé clic para seleccionar una fecha'] )}}
                        <span class="help-block">{{ ($error = $errors->first('fecha_termino')) ? $error : '' }}</span>
                    </div>
                </div>

                <div class="form-group has-feedback {{ ($error = $errors->first('estado')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="estado">Estatus</label>
                    <div class="col-md-4">
                        <div class="radio-inline">
                            <label for="estado-0">
                                {{ Form::radio("estado","Activo",(($ano_fiscal->estado == "Activo") ? true: false) )}}
                                Activo
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label for="estado-1">
                                {{ Form::radio("estado","Inactivo",(($ano_fiscal->estado == "Inactivo") ? true: false))}}
                                Inactivo
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="guardar"></label>
                    <div class="col-md-8">
                        {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
                        <a href="{{url('anos_fiscales')}}" class="btn btn-danger"> Salir</a>

                    </div>
                </div>

            </fieldset>
            {{ Form::close() }}
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('anos_fiscales.script')
    </script>
@stop