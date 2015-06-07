@extends('admin.menu')
@section("css")
    <!-- Timeline CSS -->
    {{ HTML::style("dist/css/timeline.css") }}
    <!-- Morris Charts CSS -->
    {{ HTML::style("bower_components/morrisjs/morris.css") }}
@stop
@section("contenido")
    @parent
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <div class="col-lg-4">
            <p>Insertar Contenido en esta parte</p>
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
@stop

@section("js")
    <!-- Morris Charts JavaScript -->
    {{ HTML::script("bower_components/raphael/raphael-min.js") }}
    {{ HTML::script("bower_components/morrisjs/morris.min.js") }}
    {{ HTML::script("js/morris-data.js") }}
@stop