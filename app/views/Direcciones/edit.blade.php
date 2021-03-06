@extends('admin.menu')
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header colorbrand">Direcciones</h3>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::model($direccion, array('route' => array('direcciones.update', $direccion->id_direccion), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
            <fieldset>

                <!-- Form Name -->
                <legend>Editar</legend>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('nombre')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="nombre">Nombre</label>
                    <div class="col-md-6">
                        {{ Form::text('nombre', $direccion->nombre, ['class' => 'form-control', 'placeholder' => 'Ingresar nombre', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('nombre')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('clave')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="clave">Clave</label>
                    <div class="col-md-6">
                        {{ Form::text('clave', $direccion->clave, ['class' => 'form-control', 'placeholder' => 'Ingresar clave', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('clave')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('id_dependencia')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="descripcion">Dependencia</label>
                    <div class="col-md-6">
                        {{ Form::select('id_dependencia', ['' => 'Seleccionar Dependencia'] + $dependencias, $direccion->id_dependencia, ['class' => 'form-control']) }}
                        <span class="help-block">{{ ($error = $errors->first('id_dependencia')) ? $error : '' }}</span>
                    </div>
                </div>

                <div class="form-group has-feedback {{ ($error = $errors->first('estado')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="estado">Estatus</label>
                    <div class="col-md-4">
                        <div class="radio-inline">
                            <label for="estado">
                                {{ Form::radio("estado","Activo", (($direccion->estado == "Activo") ? true: false) )}}
                                Activo
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {{ Form::radio("estado","Inactivo",(($direccion->estado == "Inactivo") ? true: false))}}
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
                        <a href="{{url('direcciones')}}" class="btn btn-danger"> Salir</a>

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