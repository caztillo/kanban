@extends('admin.menu')
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuarios</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif

            {{ Form::model($usuario, array('route' => array('usuarios.update', $usuario->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
            <fieldset>
                <!-- Form Name -->
                <legend>Editar</legend>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('first_name')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="first_name">Nombre</label>
                    <div class="col-md-6">
                        {{ Form::text('first_name', $usuario->first_name, ['class' => 'form-control', 'placeholder' => 'Ingresar nombre', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('first_name')) ? $error : '' }}</span>
                    </div>
                </div>

                <div class="form-group  has-feedback {{ ($error = $errors->first('last_name')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="last_name">Apellido</label>
                    <div class="col-md-6">
                        {{ Form::text('last_name', $usuario->last_name, ['class' => 'form-control', 'placeholder' => 'Ingresar apellido', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('last_name')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                @if($admin)

                    <div class="form-group  has-feedback {{ ($error = $errors->first('id_grupo')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="id_grupo">Rol</label>
                        <div class="col-md-6">
                            {{ Form::select('id_grupo', ['' => 'Seleccionar Rol'] + $grupos, $grupo_usuario, ['class' => 'form-control']) }}
                            <span class="help-block">{{ ($error = $errors->first('id_grupo')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('num_empleado')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="num_empleado">Número de trabajador</label>
                        <div class="col-md-6">
                            {{ Form::text('num_empleado', $usuario->num_empleado, ['class' => 'form-control', 'placeholder' => 'Ingresar número de empleado', 'maxlength' => 255] )}}
                            <span class="help-block">{{ ($error = $errors->first('num_empleado')) ? $error : '' }}</span>
                        </div>
                    </div>
                @endif




                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('email')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="email">Correo</label>
                    <div class="col-md-6">
                        {{ Form::text('email', $usuario->email, ['class' => 'form-control', 'placeholder' => 'Ingresar email', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('email')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('password')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="password">Contraseña</label>
                    <div class="col-md-6">
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingresar contraseña', 'maxlength' => 255])}}
                        <span class="help-block">{{ ($error = $errors->first('password')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('password_confirmation')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="password_confirmation">Confirmar Contraseña</label>
                    <div class="col-md-6">
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar contraseña', 'maxlength' => 255])}}
                        <span class="help-block">{{ ($error = $errors->first('password_confirmation')) ? $error : '' }}</span>
                    </div>
                </div>

                @if($admin)
                        <div class="form-group has-feedback {{ ($error = $errors->first('estado')) ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label" for="estado">Estatus</label>
                            <div class="col-md-4">
                                <div class="radio-inline">
                                    <label for="estado">
                                        {{ Form::radio("estado",1,(($usuario->activated == 1) ? true : false))}}
                                        Activo
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        {{ Form::radio("estado",0,(($usuario->activated == 0) ? true : false))}}
                                        Inactivo
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif


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
        @include('usuarios.script')
    </script>
@stop