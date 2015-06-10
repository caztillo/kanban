@extends('admin.menu')
@section("contenido_derecho")
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header colorbrand">Inscripciones</h3>
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
            @endif
            {{ Form::open(array('action'=>array('InscripcionesController@postAgregarInscripcion'), 'class' => 'form-horizontal')) }}
            {{ Form::hidden('tipo_programa', 1) }}
            <fieldset>
                <!-- Form Name -->
                <legend>Inscribir Beneficiario</legend>
                <div class="form-group  has-feedback {{ ($error = $errors->first('id_beneficiario')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="descripcion">Beneficiario</label>
                    <div class="col-md-6">
                        {{ Form::select('id_beneficiario', ['' => 'Seleccionar Beneficiario'] + $beneficiarios, '', ['class' => 'form-control']) }}
                        <span class="help-block">{{ ($error = $errors->first('id_beneficiario')) ? $error : '' }}</span>
                    </div>
                </div>

                <div class="form-group  has-feedback {{ ($error = $errors->first('id_programa')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="descripcion">Programa</label>
                    <div class="col-md-6">
                        {{ Form::select('id_programa', ['' => 'Seleccionar Programa'] + $programas, '', ['class' => 'form-control']) }}
                        <span class="help-block">{{ ($error = $errors->first('id_programa')) ? $error : '' }}</span>
                    </div>
                </div>

                <div class="form-group  has-feedback {{ ($error = $errors->first('id_direccion')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="descripcion">Dirección</label>
                    <div class="col-md-6">
                        {{ Form::select('id_direccion', ['' => 'Seleccionar Dirección'] + $direcciones, '', ['class' => 'form-control']) }}
                        <span class="help-block">{{ ($error = $errors->first('id_direccion')) ? $error : '' }}</span>
                    </div>
                </div>

                <div class="form-group has-feedback {{ ($error = $errors->first('finalidad')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="radios">Finalidad</label>
                    <div class="col-md-4">
                        <label>
                            {{ Form::radio("finalidad","Cumplida",$checked = false)}}
                            Cumplida
                        </label>
                        <label>
                            {{ Form::radio("finalidad","Incumplida",$checked = false)}}
                            Incumplida
                        </label>
                        <span class="help-block">{{ ($error = $errors->first('finalidad')) ? $error : '' }}</span>
                    </div>
                </div>

                <div class="form-group has-feedback {{ ($error = $errors->first('comentarios')) ? 'has-error' : '' }}">
                    <label class="col-md-4 control-label" for="textarea">Comentarios</label>
                    <div class="col-md-4">
                        {{ Form::textarea("comentarios",$value = null, array('class' => 'form-control')) }}
                        <span class="help-block">{{ ($error = $errors->first('comentarios')) ? $error : '' }}</span>
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="guardar"></label>
                    <div class="col-md-8">
                        {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
                        <a href="{{url('inscripciones')}}" class="btn btn-danger"> Salir</a>

                    </div>
                </div>

            </fieldset>
            {{ Form::close() }}
        </div>
    </div>

@stop
