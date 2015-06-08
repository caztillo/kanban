@extends('admin.menu')
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Programas</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{  Form::open(array('url' => 'programas', 'class' => 'form-horizontal'))  }}
            <fieldset>

                <!-- Form Name -->
                <legend>Nuevo</legend>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('id_ano')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="id_ano">Año Fiscal</label>
                    <div class="col-md-6">
                           {{Form::select('id_ano',array(''=>'Seleccionar año fiscal')+$anos_fiscales,'',array('class'=>'form-control'))}}
                        <span class="help-block">{{ ($error = $errors->first('id_ano')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('id_dependencia')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="id_dependencia">Dependencia</label>
                    <div class="col-md-6">
                           {{Form::select('id_dependencia',array(''=>'Seleccionar dependencia')+$dependencias,'',array('class'=>'form-control'))}}
                        <span class="help-block">{{ ($error = $errors->first('id_dependencia')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('clave')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="clave">Clave</label>
                    <div class="col-md-6">
                        {{ Form::text('clave', null, ['class' => 'form-control', 'placeholder' => 'Ingresar clave', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('clave')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('descripcion')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="descripcion">Descripción</label>
                    <div class="col-md-6">
                        {{ Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingresar descripcion', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('descripcion')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group  has-feedback {{ ($error = $errors->first('convocatoria')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="convocatoria">Convocatoria</label>
                    <div class="col-md-6">
                        {{ Form::text('convocatoria', null, ['class' => 'form-control', 'placeholder' => 'Ingresar convocatoria', 'maxlength' => 255] )}}
                        <span class="help-block">{{ ($error = $errors->first('convocatoria')) ? $error : '' }}</span>
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