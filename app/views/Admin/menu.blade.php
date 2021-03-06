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
                <a class="navbar-brand" href="{{url("/")}}">Sistema de Control de Beneficiarios</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php
                            $user = Sentry::getUser();
                            $grupos = $user->getGroups();
                            $grupo_usuario = 0;
                            $grupo_nombre = "";
                            foreach ($grupos as $grupo)
                            {
                                $grupo_usuario = $grupo->id;
                                $grupo_nombre = $grupo->name;
                            }

                            $label = "label-";
                            switch($grupo_nombre)
                            {
                                case "Administrador":
                                    $label.= 'primary';
                                    break;
                                case "Encargado de Dirección":
                                    $label.= 'info';
                                    break;
                                case "Encargado de Dependencia":
                                    $label.= 'success';
                                    break;
                                default:
                                    $label.= 'default';
                                    break;
                            }
                        ?>
                        {{$user->first_name }} <span class="label {{$label}}">{{$grupo_nombre}}</span>
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{url('usuarios/'.$user->id.'/edit')}}"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{url('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
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
                        @if(Sentry::getUser()->hasAccess('inscripciones.view'))
                            <li>
                                <a href="{{url('inscripciones')}}"><i class="fa fa-home"></i> Inscripción a Programas</a>
                            </li>
                        @endif
                        @if(Sentry::getUser()->hasAccess('beneficiarios_organizaciones.view'))
                                <li>
                                    <a href="{{url('beneficiarios_organizaciones')}}"><i class="fa fa-pencil"></i> Inscripción a Organizaciones</a>
                                </li>
                        @endif
                        @if(Sentry::getUser()->hasAccess('beneficiarios.view'))
                                <li>
                                    <a href="{{url('beneficiarios')}}"><i class="fa fa-group"></i> Beneficiarios</a>
                                </li>
                        @endif
                        @if(Sentry::getUser()->hasAccess('organizaciones.view'))
                                <li>
                                    <a href="{{url('organizaciones')}}"><i class="fa fa-suitcase"></i> Organizaciones</a>
                                </li>
                        @endif
                        @if(Sentry::getUser()->hasAccess('programas.view'))
                                <li>
                                    <a href="{{url('programas')}}"><i class="fa fa-list"></i> Programas</a>
                                </li>
                        @endif

                        <li>
                            <a href="#"><i class="fa fa-cogs"></i> Catálogos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @if(Sentry::getUser()->hasAccess('anos_fiscales.view'))
                                    <li>
                                        <a href="{{url('anos_fiscales')}}">Años Fiscales</a>
                                    </li>
                                @endif
                                @if(Sentry::getUser()->hasAccess('dependencias.view'))
                                        <li>
                                            <a href="{{url('dependencias')}}">Dependencias</a>
                                        </li>
                                @endif
                                @if(Sentry::getUser()->hasAccess('direcciones.view'))
                                        <li>
                                            <a href="{{url('direcciones')}}">Direcciones</a>
                                        </li>
                                @endif

                                @if(Sentry::getUser()->hasAccess('usuarios.view'))
                                    <li>
                                        <a href="{{url('usuarios')}}">Usuarios</a>
                                    </li>
                                @endif

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