@extends('admin.master')
@section('contenido')
    @parent
    <div class="container">
        <div class="row">
            {{HTML::image('img/logo.jpg','logo',['style' => 'text-align: center;margin: 0 auto;display: block;width: 50%;'])}}
            <div class="col-md-4 col-md-offset-4">
                @if(Session::has('message'))
                    <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>{{ Session::get('message')}}</div>
                @endif
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Iniciar Sesión</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('action'=>array('AdminController@loginValidacion'), 'role' => 'form')) }}
                            <fieldset>

                                <div class="form-group  has-feedback {{ ($error = $errors->first('email')) ? 'has-error' : '' }}">
                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'maxlength' => 255, 'autofocus'] )}}
                                        <span class="help-block">{{ ($error = $errors->first('email')) ? $error : '' }}</span>
                                </div>

                                <div class="form-group  has-feedback {{ ($error = $errors->first('password')) ? 'has-error' : '' }}">
                                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'maxlength' => 255])}}
                                        <span class="help-block">{{ ($error = $errors->first('password')) ? $error : '' }}</span>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox("remember","1",$checked = false)}} Recordarme
                                    </label>
                                </div>

                                {{ Form::submit('Login', array('class' => 'btn btn-lg btn-success btn-block')) }}
                            </fieldset>
                            {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop