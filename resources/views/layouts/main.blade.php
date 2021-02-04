<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="mygsystems">

    <title>Capacitación en Español</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css?v=5') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css?v=9') }}" rel="stylesheet">
    <link rel="shortcut icon" href="./favicon.png" />
    <link href="{{ asset('css/font-awesome/css/all.css') }}" rel="stylesheet" type="text/css">
    <!-- Slide Categorías -->
    <link rel="stylesheet" href="{{ asset('Tables/jquery.dataTables.css') }}">
    <!-- alertas --> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button id='btnmenu' type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">
                    <a href="/" class="marca">CAPACITACIÓN EN ESPAÑOL</a>
                </div>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">


                <li class="dropdown">

                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        @if(session()->has('Usuario'))
                            <span class='nombre'>{{session("Nombre")}} {{session("Apellido")}} </span>
                        @endif
                        
                        <i class=' fa fa-user fa-fw'></i> <i class='fa fa-caret-down'></i>
                    </a>

                    <ul class="dropdown-menu dropdown-user">
                        @if (session()->has('Usuario'))
                            <li>
                                <a href='{{route("user.edit")}}'><i class='fas fa-exchange-alt'></i> Modificar Datos</a>
                            </li>
                             @if(session('Perfil')=="profesor")
                             <li>
                                <a href='/Profesor/MisPreferencias'><i class='fas fa-id-card'></i> Mis Preferencias</a>
                            </li>
                             @endif
                            <li>
                                <a href='/Logout'><i class='fa fa-sign-out-alt'></i> Logout</a>
                            </li>
                        @else
                            <li>
                                <a href='/Login'><i class='fas fa-exchange-alt'></i> Ingresar</a>
                            </li>
                            <li>
                                <a href='/Registro/Alumno'><i class='fas fa-book-reader'></i> Registro Alumno</a>
                            <li>
                                <a href='/Registro/Profesor'><i class='fas fa-chalkboard-teacher'></i> Registro Profesor</a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        @if (session()->has('Usuario'))
                        @switch(session('Perfil'))
                            @case("admin")
                            <li>
                            <a href='#'><i class='fas fa-cogs'></i> CONFIGURACIÓN <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a href='/Categoria'> <i class='fas fa-folder-open'></i> Categorias</a>
                                </li>
                                <li>
                                    <a href='/Especialidad'> <i class='fas fa-user-tag'></i> Especialidades</a>
                                </li>
                                {{-- <li>
                                    <a href='/RangoHorario'> <i class='far fa-clock'></i> Rangos Horarios</a>
                                </li>
                                <li>
                                    <a href='/Monto'> <i class='far fa-money-bill-alt'></i> Monto por hora</a>
                                </li> --}}
                            </ul>
                        </li>
                        <li>
                            <a href='#'><i class='fas fa-chalkboard-teacher'></i> PROFESORES <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a  href='/AdministrarProfesores'> <i class='fas fa-user-cog'></i> Administración de Profesores</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='#'><i class='fas fa-book-reader'></i> ALUMNOS <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a  href='/AdministrarAlumnos'> <i class='fas fa-user-cog'></i> Administración de Alumnos</a>
                                </li>
                            </ul>
                        </li>
                                @break
                        @case('profesor')
                        @switch(session('Estado'))
                            @case("validado")
                                <li>
                                    <a href='#'><i class='fas fa-photo-video'></i> PUBLICACIONES <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/Publicaciones/Create'> <i class='fas fa-plus'></i> Nueva publicación</a>
                                        </li>
                                        <li>
                                            <a  href='/Publicaciones'> <i class='fas fa-list-ol'></i> Mis publicaciones</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'><i class='fas fa-chalkboard-teacher'></i> CLASES <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/AdministrarProfesores'> <i class='fas fa-clipboard-check'></i> Clases realizadas</a>
                                        </li>
                                        <li>
                                            <a  href='/AdministrarProfesores'> <i class='fas fa-list-ol'></i> Clases pendientes</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'><i class='fas fa-file-invoice-dollar'></i> PAGOS <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/AdministrarProfesores'> <i class='fas fa-user-cog'></i> Mis clases</a>
                                        </li>
                                    </ul>
                                </li>
                                @break
                            @default
                        @endswitch
                        @break
                        @case('alumno')
                        @switch(session('Estado'))
                            @case("validado")
                            <li>
                                <a href='/Cursos'><i class='fab fa-searchengin'></i> BUSCAR CURSOS</a>
                            </li>
                                <li>
                                    <a href='#'><i class='fas fa-chalkboard-teacher'></i> CLASES <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/AdministrarProfesores'> <i class='fas fa-clipboard-check'></i> Clases realizadas</a>
                                        </li>
                                        <li>
                                            <a  href='/AdministrarProfesores'> <i class='fas fa-list-ol'></i> Clases pendientes</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'><i class='fas fa-file-invoice-dollar'></i> PAGOS <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/AdministrarProfesores'> <i class='fas fa-user-cog'></i> Mis clases</a>
                                        </li>
                                    </ul>
                                </li>
                                @break
                            @default
                        @endswitch
                        @break
                         @default
                    @endswitch
                    @else
                        <li>
                            <a href='/Cursos'><i class='fab fa-searchengin'></i> BUSCAR CURSOS</a>
                        </li>   
                        <li>
                            <a href='/Login'><i class='fas fa-exchange-alt'></i> INGRESAR</a>
                        </li>
                        <li>
                            <a href='/Registro/Alumno'><i class='fas fa-book-reader'></i> REGISTRO ALUMNO</a>
                            <a href='/Registro/Profesor'><i class='fas fa-chalkboard-teacher'></i> REGISTRO PROFESOR</a>
                        </li>
                    @endif

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @if (session()->has('success'))
                    <script>
                        swal("Acción correcta","{{session('success')}}", "success");
                    </script>
            @endif
            @yield('content')
        </div>
        <!-- /#page-wrapper -->
        <div class="footer">
            Desarrollado por <a href="https://www.mygsystems.com">M&G Systems.com</a>
        </div>
    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <!-- Acciones para pedidos -->
    {{-- <script src="js/Acciones/acciones.js?v=6"></script> --}}
    <script src="{{ asset('Tables/jquery.dataTables.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/sb-admin-2.js')}}"></script>
    {{-- <script src="js/sweetalert.min.js"></script> --}}
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js')}}"></script>
    <!-- Alertas -->

    <script>

        function openmenu() {
            document.getElementById('btnmenu').click();
        }
    </script>
</body>

</html>