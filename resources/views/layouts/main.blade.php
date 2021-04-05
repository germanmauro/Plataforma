<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Capacitación en español, todos los cursos que buscas">
    <meta name="author" content="mygsystems">

    <title>Capacitación en Español</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css?v=12') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css?v=41') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('image/logo.png')}}" />
    <link href="{{ asset('css/font-awesome/css/all.css') }}" rel="stylesheet" type="text/css">
    <!-- Slide Categorías -->
    <link rel="stylesheet" href="{{ asset('Tables/jquery.dataTables.css') }}">
    <!-- alertas --> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('head')
</head>

<body>

    <div id="wrapper">
        <div id="banner">
            <div class="imagenbanner">
                <a href="/#banner">
                    <img src="{{asset('image/logo.png')}}"/>
                </a>
            </div>
            <div class="textobanner">
                <h1>
                    CAPACITACIÓN EN ESPAÑOL
                </h1>
                <p>
                    Aprendé desde tu casa lo que siempre deseaste
                </p>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="">
                <button id='btnmenu' type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                @if(session()->has('Perfil'))
                <li class="dropdown notifications">
                    
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        <i class='fa fa-bell'></i> 
                        @if (count($notifications)>0)
                        <span class="label label-warning">
                           {{ count($notifications)}}
                        </span>
                        @endif
                    </a>
                    
                    <ul class="dropdown-menu">
                        @foreach ($notifications as $item)
                            <li>
                                <a href='/Notificaciones/{{$item->id}}/Show'>{{$item->texto}}</a>
                            </li>
                           
                        @endforeach
                        @if (count($notifications)>1)
                            <li>
                                <a href="/Notificaciones/Todas">VER TODAS</a>
                            </li>
                        @endif
                        @if (count($notifications)==0)
                            <li>
                                <a>Sin notificaciones nuevas</a>
                            </li>
                        @endif
                    </ul>
                </li>
                @endif
                <li class="dropdown">
                    
                    <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        @if(session()->has('Perfil'))
                            <span class='nombre'>{{session("Nombre")}} {{session("Apellido")}} </span>
                        @else
                            Ingresa al sistema
                        @endif
                        
                        <i class=' fa fa-user fa-fw'></i> <i class='fa fa-caret-down'></i>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-user">
                        @if (session()->has('Perfil'))
                            <li>
                                <a href='{{route("user.edit")}}'><i class='fas fa-exchange-alt'></i> Modificar Datos</a>
                            </li>
                             @if(session('Perfil')=="profesor")
                             <li>
                                <a href='/Profesor/MisPreferencias'><i class='fas fa-id-card'></i> Mis Preferencias</a>
                            </li>
                             @endif
                             @if(session('Perfil')=="alumno")
                             <li>
                                <a href='/Alumno/MisFavoritos'><i class='fas fa-star'></i> Mis Favoritos</a>
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

            <div class="navbar-collapse" role="navigation">
                <div class="navbar-collapse pull-left">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href='/'><i class='fab fa-searchengin'></i> BUSCAR CURSOS</a>
                        </li> 
                        <li>
                            <a href='/Nosotros'><i class='fas fa-users'></i> NOSOTROS</a>
                        </li> 
                        <li>
                            <a href='/Contacto'><i class='fas fa-envelope'></i> CONTACTO</a>
                        </li>
                        @if (session()->has('Perfil'))
                        @switch(session('Perfil'))
                            @case("admin")
                            <li>
                            <a href='#'><i class='fas fa-cogs'></i> CONFIGURACIÓN <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a href='/Categoria'> <i class='fas fa-folder-open'></i> Categorias</a>
                                </li>
                                <li>
                                    <a href='/Contrato'> <i class='fas fa-folder-open'></i> Carga Contrato</a>
                                </li>
                                <li>
                                    <a href='/Especialidad'> <i class='fas fa-user-tag'></i> Especialidades</a>
                                </li>
                                {{-- <li>
                                    <a href='/RangoHorario'> <i class='far fa-clock'></i> Rangos Horarios</a>
                                </li> --}}
                                <li>
                                    <a href='/Monto'> <i class='far fa-money-bill-alt'></i>Porcentaje de cobro</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='#'><i class='fas fa-chalkboard-teacher'></i> PROFESORES <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a  href='/AdministrarProfesores'> <i class='fas fa-user-cog'></i> Administración de Profesores</a>
                                </li>
                                <li>
                                    <a  href='/Pagos/Transferir'> <i class='fas fa-hand-holding-usd'></i> Dinero  a transferir</a>
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
                        <li>
                            <a href='#'><i class='fas fa-file-invoice-dollar'></i> PAGOS <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a  href='/Pagos/Recibidos'> <i class='fas fa-clipboard-check'></i> Recibidos</a>
                                </li>
                                <li>
                                    <a  href='/Pagos/Pendientes'> <i class='fas fa-clock'></i> Pendientes</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='#'><i class='fas fa-chalkboard-teacher'></i> CLASES <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a  href='/Clases/Avisos'> <i class='fas fa-envelope'></i> Envio de avisos</a>
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
                                    <a href='#'><i class='fas fa-chalkboard-teacher'></i> CURSOS <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/Profesor/ClasesRealizadas'> <i class='fas fa-clipboard-check'></i> Finalizados</a>
                                        </li>
                                        <li>
                                            <a  href='/Profesor/ClasesPendientes'> <i class='fas fa-clock'></i> Pendientes</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'><i class='fas fa-file-invoice-dollar'></i> PAGOS <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/Profesor/Pagos/Recibidos'> <i class='fas fa-clipboard-check'></i> Recibidos</a>
                                        </li>
                                        <li>
                                            <a  href='/Profesor/Pagos/Pendientes'> <i class='fas fa-clock'></i> Pendientes</a>
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
                                    <a href='#'><i class='fas fa-chalkboard-teacher'></i> CURSOS <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/Alumno/ClasesRealizadas'> <i class='fas fa-clipboard-check'></i> Finalizados</a>
                                        </li>
                                        <li>
                                            <a  href='/Alumno/ClasesPendientes'> <i class='fas fa-clock'></i> Pendientes</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'><i class='fas fa-file-invoice-dollar'></i> PAGOS <span class='fas fa-angle-double-right'></span></a>
                                    <ul class='nav nav-second-level'>
                                        <li>
                                            <a  href='/Alumno/Pagos/Realizados'> <i class='fas fa-clipboard-check'></i> Realizados</a>
                                        </li>
                                        <li>
                                            <a  href='/Alumno/Pagos/Pendientes'> <i class='fas fa-clock'></i> Pendientes</a>
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
                            <a href='/Login'><i class='fas fa-exchange-alt'></i> INGRESAR</a>
                        </li>
                        <li>
                            <a href='#'><i class='fas fa-book'></i> REGISTRO <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a  href='/Registro/Alumno'> <i class='fas fa-book-reader'></i> Alumno</a>
                                </li>
                                <li>
                                    <a  href='/Registro/Profesor'> <i class='fas fa-chalkboard-teacher'></i> Profesor</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        @yield('header')
        <div id="page-wrapper">
            @if (session()->has('success'))
                    <script>
                        swal("Acción correcta","{{session('success')}}", "success");
                    </script>
            @endif
            @if (session()->has('warning'))
                    <script>
                        swal("¡Atención!","{{session('warning')}}", "warning");
                    </script>
            @endif
            @if (session()->has('error'))
                    <script>
                        swal("¡Atención!","{{session('error')}}", "error");
                    </script>
            @endif
@if(session()->has('Perfil')&&session('Perfil')!="admin")
    @if (count($pendientes)>0)
        <div class="alert alert-danger" role="alert">
            Tiene cuotas por vencer
        </div>
    @endif
    @switch(session('Estado'))
        @case("registrado")
            <div class="alert alert-danger" role="alert">
                Debe validar su e-mail. Le hemos enviado un correo a su casiila. 
                Si no lo encuentra revise el spam.
            </div>
            @break
        @case("contrato a enviar")
           <div class="alert alert-danger" role="alert">
                Debe subir el contrato recibido por e-mail firmado. <a href="/Contrato/Envio" class="btn btn-default"> Cargueló aquí </a>
           </div>
            @break
        @case("a entrevistar")
           <div class="alert alert-success" role="alert">
                La administración de Capacitación en Español lo contactará vía e-mail para concertar una
                entrevista vía Google Meet.
           </div>
            @break
        @case("invalidado")
           <div class="alert alert-danger" role="alert">
                Su usuario ha sido deshabilitado
           </div>
            @break
    @endswitch
@endif      
             
             @yield('content')
             <div id="loader" class="loader" style="display: none">
                 <div class="circulo"></div>
             </div>
        </div>
        
        <!-- /#page-wrapper -->
        <div class="footer">
            Desarrollado por <a href="https://www.mygsystems.com">M&G Systems.com</a> 
            - <a href="/PoliticaPrivacidad">Política de privacidad</a> 
            - <a href="/Registro/Terminos">Términos y condiciones</a>
            - <a href="/FAQ">FAQ</a>
        </div>
    </div>
    <!-- /#wrapper -->
    <script>
        var element = document.querySelector("#page-wrapper");
        // scroll to element
        element.scrollIntoView();
        var element = document.querySelector("#menu-secundario");
        // scroll to element
        element.scrollIntoView();
    </script>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <!-- Acciones para pedidos -->
    {{-- <script src="js/Acciones/acciones.js?v=6"></script> --}}
    <script src="{{ asset('Tables/jquery.dataTables.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/sb-admin-2.js?v=2')}}"></script>
    {{-- <script src="js/sweetalert.min.js"></script> --}}
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js')}}"></script>
    <!-- Alertas -->
    <script>
        function loader()
        {
            $("#loader").show();
        }
        
    </script>
    @yield("scripts")
</body>

</html>