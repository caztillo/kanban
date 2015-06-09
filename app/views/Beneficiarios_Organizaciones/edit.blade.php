@extends('admin.menu')
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inscripción</h1>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{  Form::open(array('url' => 'beneficiarios_organizaciones', 'class' => 'form-horizontal'))  }}
                <fieldset>
                    <!-- Form Name -->
                    <legend>Nuevo</legend>

                     <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('id_organizacion')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="organizacion">Organización</label>
                        <div class="col-md-6">
                            {{ Form::select('id_organizacion', ['' => 'Seleccionar Organización'] + $organizaciones, '', ['class' => 'form-control']) }}
                            <span class="help-block">{{ ($error = $errors->first('id_organizacion')) ? $error : '' }}</span>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('id_beneficiario')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="beneficiario">Beneficiario</label>
                        <div class="col-md-6">
                            {{ Form::select('id_beneficiario', ['' => 'Seleccionar Beneficiario'] + $beneficiarios, '', ['class' => 'form-control']) }}
                            <span class="help-block">{{ ($error = $errors->first('id_beneficiario')) ? $error : '' }}</span>
                        </div>
                    </div>
            
                    <!-- Text input-->
                    <div class="form-group  has-feedback {{ ($error = $errors->first('comentarios')) ? 'has-error' : '' }}">
                        <label class="col-md-4 control-label" for="comentarios">Comentarios</label>
                        <div class="col-md-6">
                            {{ Form::textarea('comentarios', null, ['class' => 'form-control', 'placeholder' => 'Ingresar comentarios', 'maxlength' => 10000] )}}
                            <span class="help-block">{{ ($error = $errors->first('direccion')) ? $error : '' }}</span>
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
                            <a href="{{url('beneficiarios_organizaciones')}}" class="btn btn-danger"> Salir</a>

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