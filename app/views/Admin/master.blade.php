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

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">Sistema de Control de Beneficiarios</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i> Inscripciones</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Beneficiarios</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-table fa-fw"></i> Organizaciones</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit fa-fw"></i> Programas</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Catálogos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Roles</a>
                            </li>
                            <li>
                                <a href="#">Usuarios</a>
                            </li>
                            <li>
                                <a href="{{url('dependencias')}}">Dependencias</a>
                            </li>
                            <li>
                                <a href="#">Direcciones</a>
                            </li>
                            <li>
                                <a href="{{url('anos_fiscales')}}">Años Fiscales</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            @yield("contenido")
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

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
