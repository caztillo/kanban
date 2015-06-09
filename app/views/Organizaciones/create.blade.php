@extends('admin.menu')
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Organizaciones</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{  Form::open(array('url' => 'organizaciones', 'class' => 'form-horizontal'))  }}
                <fieldset>
                    <!-- Form Name -->
                    <legend> Nuevo</legend>
                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('nombre')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="nombre">Nombre</label>
                        <div class="col-md-6">
                            {{ Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingresar nombre de la organización', 'maxlength' => 255] )}}
                            <span class="help-block">{{ ($error = $errors->first('nombre')) ? $error : '' }}</span>
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
                    <div class="form-group  has-feedback {{ ($error = $errors->first('razon_social')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="razon_social">Razón Social</label>
                        <div class="col-md-6">
                            {{ Form::text('razon_social', null, ['class' => 'form-control', 'placeholder' => 'Ingresar razón social', 'maxlength' => 255] )}}
                            <span class="help-block">{{ ($error = $errors->first('razon_social')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('direccion')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="descripcion">Dirección</label>
                        <div class="col-md-6">
                            {{ Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Ingresar dirección', 'maxlength' => 255] )}}
                            <span class="help-block">{{ ($error = $errors->first('direccion')) ? $error : '' }}</span>
                        </div>
                    </div>


                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('codigo_postal')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="codigo_postal">Código Postal</label>
                        <div class="col-md-6">
                            {{ Form::text('codigo_postal', null, ['class' => 'form-control', 'placeholder' => 'Ingresar código postal', 'maxlength' => 5] )}}
                            <span class="help-block">{{ ($error = $errors->first('codigo_postal')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('contacto')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="contacto">Contacto</label>
                        <div class="col-md-6">
                            {{ Form::text('contacto', null, ['class' => 'form-control', 'placeholder' => 'Ingresar nombre del contacto', 'maxlength' => 255] )}}
                            <span class="help-block">{{ ($error = $errors->first('contacto')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('telefono')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="telefono">Teléfono</label>
                        <div class="col-md-6">
                            {{ Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingresar teléfono', 'maxlength' => 10] )}}
                            <span class="help-block">{{ ($error = $errors->first('telefono')) ? $error : '' }}</span>
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
                            <a href="{{url('organizaciones')}}" class="btn btn-danger"> Salir</a>

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