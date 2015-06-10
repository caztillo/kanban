@extends('admin.master')
@section('css')
    {{ HTML::style("css/custom.css") }}
@stop
@section('contenido')
    @parent
    <div class="container">
        <div class="row">
            {{HTML::image('img/logo.jpg','logo',['style' => 'text-align: center;margin: 0 auto;display: block;width: 50%;'])}}
         
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template">
                        <h1>Error 404</h1>
                        <h2>Página no encontrada</h2>
                        <div class="error-details">
                            La página que buscas no existe
                        </div>
                        <div class="error-actions">
                            <a href="{{url('/')}}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                                Regresar al inicio </a><a href="#" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contacto </a>
                        </div>
                     </div>
                </div>
            </div>
             

        </div>
    </div>
@stop

