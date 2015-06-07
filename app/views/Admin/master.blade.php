<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Control de Beneficiarios</title>

    <!-- Bootstrap Core CSS -->
    {{ HTML::style("bower_components/bootstrap/dist/css/bootstrap.min.css") }}
    <!-- MetisMenu CSS -->
    {{ HTML::style("bower_components/metisMenu/dist/metisMenu.min.css") }}
    {{ HTML::style("css/bootstrap-datetimepicker.min.css") }}
    @yield("css")


    <!-- Custom CSS -->
    {{ HTML::style("dist/css/sb-admin-2.css") }}
    <!-- Custom Fonts -->
    {{ HTML::style("bower_components/font-awesome/css/font-awesome.min.css") }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{ HTML::script("js/html5shiv.js") }}
    {{ HTML::script("js/respond.min.js") }}
    <![endif]-->

</head>

<body>
@yield("contenido")

<!-- jQuery -->
{{ HTML::script("bower_components/jquery/dist/jquery.min.js") }}

<!-- Bootstrap Core JavaScript -->
{{ HTML::script("bower_components/bootstrap/dist/js/bootstrap.min.js") }}
<!-- Metis Menu Plugin JavaScript -->

{{ HTML::script("bower_components/metisMenu/dist/metisMenu.min.js") }}
{{ HTML::script("js/moment.js") }}
{{ HTML::script("js/es.js") }}
{{ HTML::script("js/bootstrap-datetimepicker.min.js") }}

@yield("js")


<!-- Custom Theme JavaScript -->
{{ HTML::script("dist/js/sb-admin-2.js") }}
</body>

</html>
t