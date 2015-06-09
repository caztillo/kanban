@extends('admin.master')
@section('css')
    @yield('css')
@stop
@section("contenido")
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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
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
                            <a href="{{url('inscripciones')}}"><i class="fa fa-pencil"></i> Inscripciones</a>
                        </li>
                        <li>
                            <a href="{{url('beneficiarios_organizaciones')}}"><i class="fa fa-pencil"></i> Inscripción de Beneficiario a Organización</a>
                        </li>
                        <li>
                            <a href="{{url('beneficiarios')}}"><i class="fa fa-group"></i> Beneficiarios</a>
                        </li>
                        <li>
                            <a href="{{url('organizaciones')}}"><i class="fa fa-suitcase"></i> Organizaciones</a>
                        </li>
                        <li>
                            <a href="{{url('programas')}}"><i class="fa fa-list"></i> Programas</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cogs"></i> Catálogos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('anos_fiscales')}}">Años Fiscales</a>
                                </li>
                                <li>
                                    <a href="{{url('dependencias')}}">Dependencias</a>
                                </li>
                                <li>
                                    <a href="{{url('direcciones')}}">Direcciones</a>
                                </li>
                                <li>
                                    <a href="#">Roles</a>
                                </li>
                                <li>
                                    <a href="#">Usuarios</a>
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
                {{HTML::image('img/logo.jpg','logo',['style' => 'text-align: center;margin: 0 auto;display: block;width: 50%;'])}}
                @yield("contenido_derecho")
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@stop

@section('js')
    @yield('js')
@stop