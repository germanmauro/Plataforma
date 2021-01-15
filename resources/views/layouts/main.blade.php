<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="mygsystems">

    <title>Plataforma de clases de profesores y alumnos</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css?v=5') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css?v=7') }}" rel="stylesheet">
    <link rel="shortcut icon" href="./favicon.png" />
    <link href="{{ asset('css/font-awesome/css/all.css') }}" rel="stylesheet" type="text/css">
    <!-- Slide Categorías -->
    <link rel="stylesheet" href="{{ asset('Tables/jquery.dataTables.css') }}">
    <!-- alertas 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->

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
                <div class="navbar-brand">PLATAFORMA DE GESTIÓN DE CLASES</div>
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
                                <a onclick=paginaPrincipal('cambioNombre.php')><i class='fas fa-exchange-alt'></i> Modificar Datos</a>
                            </li> 
                            <li>
                                <a href='/Logout'><i class='fa fa-sign-out-alt'></i> Logout</a>
                            </li>
                        @else
                            <li><a href='/Login'><i class='fas fa-exchange-alt'></i> Ingresar</a>
                            </li>
                            <li><a href='/Registro/Alumno'><i class='fas fa-book-reader'></i> Registro Alumno</a>
                            <li><a href='/Registro/Profesor'><i class='fas fa-chalkboard-teacher'></i> Registro Profesor</a>
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
                                    <a href='/Especialidad'> <i class='fas fa-folder-open'></i> Especialidades</a>
                                </li>
                                <li>
                                    <a href='Configuracion/index.php'> <i class='fas fa-cog'></i> Monto por hora</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='#'><i class='fas fa-chalkboard-teacher'></i> PROFESORES <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a href='Categoria/index.php'> <i class='fas fa-folder-open'></i> Categorías</a>
                                </li>
                                <li>
                                    <a href='Producto/index.php'> <i class='fas fa-carrot'></i> Productos </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='#'><i class='fas fa-book-reader'></i> ALUMNOS <span class='fas fa-angle-double-right'></span></a>
                            <ul class='nav nav-second-level'>
                                <li>
                                    <a  href='AdministrarAlumnos'> <i class='fas fa-user-cog'></i> Administración de Alumnos</a>
                                </li>
                                <li>
                                    <a href='Pedido/index.php'> <i class='fas fa-table'></i> Gestión de Pedidos </a>
                                </li>
                                <li>
                                    <a href='Imprimir/index.php'> <i class='fas fa-print'></i> Imprimir Pedidos</a>
                                </li>
                                <li>
                                    <a href='Reporte/index.php'> <i class='fas fa-file-download'></i> Reporte de Entrega Diaria</a>
                                </li>
                            </ul>
                        </li>
                                @break
                        @case('alumno')
                        <li>
                            <a onclick=irPaginaPrincipal('pedido.php')><i class='fas fa-shopping-cart'></i> COMPRAR</a>
                        </li>
                        <li>
                            <a onclick=irPaginaPrincipal('pedidodetalle.php')><i class='fas fa-shopping-basket'></i> VER CANASTA</a>
                        </li>
                        <li>
                            <a onclick=irPaginaPrincipal('mispedidos.php')><i class='fas fa-clipboard-list'></i></i> MIS PEDIDOS</a>
                        </li>
                         @break
                        @case('profesor')
                        <li>
                            <a onclick=irPaginaPrincipal('pedido.php')><i class='fas fa-shopping-cart'></i> PROFESOR</a>
                        </li>
                        <li>
                            <a onclick=irPaginaPrincipal('pedidodetalle.php')><i class='fas fa-shopping-basket'></i> VER CANASTA</a>
                        </li>
                        <li>
                            <a onclick=irPaginaPrincipal('mispedidos.php')><i class='fas fa-clipboard-list'></i></i> MIS PEDIDOS</a>
                        </li>
                            @break
                         @default
                    @endswitch
                    @else    
                        <li>
                            <a href='/Login'><i class='fas fa-exchange-alt'></i> INGRESAR</a>
                        </li>
                        <li>
                            <a href='/Registro/Alumno'><i class='fas fa-book-reader'></i> REGISTRO ALUMNO</a>
                            <a href='/Registro/Profesor'><i class='fas fa-chalkboard-teacher'></i> REGISTO PROFESOR</a>
                        </li>
                    @endif

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->
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
    <script src="js/sweetalert.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js')}}"></script>
    <!-- Alertas -->


    <script>
        //TODAS LAS FUNCIONES PARA CARGAR LAS PAGINAS SIN REGARGAR
        //LLama a la funcion cada 10 seg
        // setInterval("irPagina('dashboard.php')",20000);

        //Funcion para no cambiar de página
        function irPaginaPrincipal(pag) {
            $("#page-wrapper").load(pag);
            document.getElementById('btnmenu').click();
        }

        function paginaPrincipal(pag, param = "") {
            $("#page-wrapper").load(pag, param);
        }

        //Funcion para no cambiar de página
        function irSubPagina(pag) {
            $("#sub-pagina").load(pag);
            document.getElementById('btnmenu').click();
        }

        function subPagina(pag, param) {
            // alert(parametros);
            $("#sub-pagina").load(pag, param);
        }

        function recargaPedido() {
            // alert(parametros);
            $("#cantidadpedidos").load('itemspedido.php');
        }

        function openmenu() {
            document.getElementById('btnmenu').click();
        }
    </script>
</body>

</html>