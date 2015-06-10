@extends('admin.menu')
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuarios</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{  Form::open(array('url' => 'usuarios', 'class' => 'form-horizontal'))  }}
            <fieldset>
                <!-- Form Name -->
                <legend>Nuevo</legend>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('nombre')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="nombre">Nombre</label>
                    <div class="col-md-6">
                        {{ Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingresar nombre', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('nombre')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('id_dependencia')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="descripcion">Rol</label>
                    <div class="col-md-6">
                        {{ Form::select('id_rol', ['' => 'Seleccionar Rol'], '', ['class' => 'form-control']) }}
                        <span class="help-block">{{ ($error = $errors->first('id_rol')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('num_empleado')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="num_empleado">Número de trabajador</label>
                    <div class="col-md-6">
                        {{ Form::text('num_empleado', null, ['class' => 'form-control', 'placeholder' => 'Ingresar número de empleado', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('num_empleado')) ? $error : '' }}</span>
                    </div>
                </div>

               <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('correo')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="correo">Correo</label>
                    <div class="col-md-6">
                        {{ Form::text('correo', null, ['class' => 'form-control', 'placeholder' => 'Ingresar correo', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('correo')) ? $error : '' }}</span>
                    </div>
                </div>

                 <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('contrasena')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="contrasena">Contraseña</label>
                    <div class="col-md-6">
                        {{ Form::text('contrasena', null, ['class' => 'form-control', 'placeholder' => 'Ingresar contraseña', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('contrasena')) ? $error : '' }}</span>
                    </div>
                </div>

                 <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('confirmacion')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="confirmacion">Confirmación</label>
                    <div class="col-md-6">
                        {{ Form::text('confirmacion', null, ['class' => 'form-control', 'placeholder' => 'Confirmar contraseña', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('confirmacion')) ? $error : '' }}</span>
                    </div>
                </div>

                <div class="form-group has-feedback {{ ($error = $errors->first('estado')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="estado">Estatus</label>
                    <div class="col-md-4">
                        <div class="radio-inline">
                            <label for="estado">
                                {{ Form::radio("estado","Activo",$checked = true)}}
                                Activo
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {{ Form::radio("estado","Inactivo",$checked = false)}}
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
                        <a href="{{url('usuarios')}}" class="btn btn-danger"> Salir</a>
                    </div>
                </div>

            </fieldset>
            {{ Form::close() }}
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('direcciones.script')
    </script>
@stop