@extends('admin.menu')
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header colorbrand">Beneficiarios</h3>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{  Form::open(array('url' => 'beneficiarios', 'class' => 'form-horizontal'))  }}
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
                    <div class="form-group  has-feedback {{ ($error = $errors->first('direccion')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="direccion">Dirección</label>
                        <div class="col-md-6">
                            {{ Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Ingresar dirección', 'maxlength' => 255] )}}
                            <span class="help-block">{{ ($error = $errors->first('direccion')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('codigo_postal')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="codigo_postal">Código Postal</label>
                        <div class="col-md-6">
                            {{ Form::text('codigo_postal', null, ['class' => 'form-control', 'placeholder' => 'Ingresar código postal', 'maxlength' =>5] )}}
                            <span class="help-block">{{ ($error = $errors->first('codigo_postal')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('telefono')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="telefono">Teléfono</label>
                        <div class="col-md-6">
                            {{ Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingresar teléfono', 'maxlength' =>10] )}}
                            <span class="help-block">{{ ($error = $errors->first('telefono')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('correo')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="correo">Correo</label>
                        <div class="col-md-6">
                            {{ Form::text('correo', null, ['class' => 'form-control', 'placeholder' => 'Ingresar correo', 'maxlength' =>100] )}}
                            <span class="help-block">{{ ($error = $errors->first('correo')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('fecha_nacimiento')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <div class="col-md-6">
                            {{ Form::text('fecha_nacimiento', null, ['class' => 'form-control', 'placeholder' => 'Ingresar fecha de nacimiento', 'maxlength' =>10] )}}
                            <span class="help-block">{{ ($error = $errors->first('fecha_nacimiento')) ? $error : '' }}</span>
                        </div>
                    </div>

                     <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('pais_nacionalidad')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="pais_nacionalidad">País de Nacionalidad</label>
                        <div class="col-md-6">
                           {{Form::select('pais_nacionalidad',array(''=>'Seleccionar país de nacionalidad')+$paises,'',array('class'=>'form-control'))}}
                            <span class="help-block">{{ ($error = $errors->first('pais_nacionalidad')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('RFC')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="RFC">RFC</label>
                        <div class="col-md-6">
                            {{ Form::text('RFC', null, ['class' => 'form-control', 'placeholder' => 'Ingresar RFC', 'maxlength' => 13] )}}
                            <span class="help-block">{{ ($error = $errors->first('RFC')) ? $error : '' }}</span>
                        </div>
                    </div>

                      <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('CURP')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="nombre">CURP</label>
                        <div class="col-md-6">
                            {{ Form::text('CURP', null, ['class' => 'form-control', 'placeholder' => 'Ingresar CURP', 'maxlength' => 18] )}}
                            <span class="help-block">{{ ($error = $errors->first('CURP')) ? $error : '' }}</span>
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
                                    {{ Form::radio("estado","Vetado",$checked = false)}}
                                    Vetado
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Button (Double) -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="guardar"></label>
                        <div class="col-md-8">
                            {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
                            <a href="{{url('beneficiarios')}}" class="btn btn-danger"> Salir</a>

                        </div>
                    </div>

                </fieldset>
            {{ Form::close() }}
        </div>
    </div>

@stop
@section("js")
    <script>
        @include('beneficiarios.script')
    </script>
@stop