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
    <link href="{{ asset('css/sb-admin-2.css?v=46') }}" rel="stylesheet">
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
        <div class="contrato">
                <form name="envio" id="envio" role="form" action="{{route('user.uploadcontract')}}" method="POST">
                    @method("put")
                    @csrf
                    <div class="error">
                        @error('terminos')
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <div class="contratodetalle">
                            <h3>Términos  de Uso para Docentes</h3>
                            <p>
                                Estos Términos y Condiciones regulan el acceso y uso efectuado por Ud. en su calidad de usuario, en adelante denominado
                                “Docente” en relación a  los servicios comercializados  a través de CEE dirigido a los  usuarios en adelante denominados
                                 “Alumnos”.
                            </p>
                            <p>Si Usted no está de acuerdo con estos Términos y con las Políticas de Privacidad no podrá utilizar CCE para prestar sus Servicios. Su acuerdo con CEE se compone de las cláusulas y condiciones establecidas en este documento, junto con las políticas de privacidad. Si existieran discrepancias entre las políticas de privacidad y el presente documento, prevalecerá este documento.</p>
                            <p>PRIMERA: CEE le otorga a Usted la posibilidad de utilizar nuestras aplicaciones de software de comunicación por Internet a los fines de que Ud.  pueda a través de la plataforma dictar clases y/o cursos grupales bajo la modalidad educación a distancia.</p>
                            <p>SEGUNDA: El dictado de las clases y/o cursos, cuya modalidad de cursada será sincrónica, serán propuestos por el Docente, el que deberá determinar la materia sobre la cual tratarán los mismos, el contenido, la asignatura, material de estudio y todos los demás elementos didácticos que crea pertinentes los cuales, una vez diseñados, serán presentados a CEE para su aprobación.</p>
                            <p>TERCERA:  Una vez aprobadas las clases y/o curso por CCE, Ud. deberá ingresar a la plataforma a los fines de crear su respectivo usuario y poder de esta manera efectuar la correspondiente publicación y publicidad de las clases y/o cursos que va a dictar. Ud. se compromete a proporcionar información precisa, actualizada y completa durante el proceso de inscripción y a la actualización de dicha información para mantenerla exacta, actualizada y completa.</p>
                            <p>CUARTA: Luego de registrarse en CCE Ud., en su calidad de Docente determinará y publicará el costo de la clase y/o curso en la plataforma, previa autorización de CCE.  El costo de los mismos debe estar publicado en moneda EURO. Se deja asentado que la primera clase del alumno en la plataforma será gratuita, a modo de estrategia comercial.</p>
                            <p>QUINTA: Por el servicio que CCE le brinda, Ud. deberá abonar a esta última la suma equivalente al 40% del costo total de la clase y/o curso que se dicte a través de nuestra plataforma. La modalidad de pago será en moneda EURO. Los futuros alumnos efectuarán los pagos a través de PayPal, procediendo luego CCE a retener las sumas correspondientes al porcentaje acordado y a depositar el saldo del precio correspondiente al 60% del costo de la clase y/o curso en la cuenta de titularidad del Docente denunciada por éste del 1 al 10 de cada mes en moneda Peso Argentino al tipo de cambio EURO OFICIAL.</p>
                            <p>SEXTA: Los días y horarios en los cuales se dictarán las clases y/o cursos serán propuestos por el Docente, teniendo en cuenta el huso horario de Roma (Capital de Italia) reservándose CEE la autorización y modificación de los mismos.</p>
                            <p>SEPTIMA: CCE sólo proporciona a los Docentes la siguiente información sobre los alumnos inscriptos en sus formaciones: (1) nombre del alumno y (2) el nombre de la formación/contenido en la cual el alumno se ha inscripto. Una vez que el alumno se registra en la plataforma, el Docente se compromete a dictar el curso y/o clase que el alumno vaya a cursar únicamente a través de CCE y la modalidad que esta última determine aplicándose sanciones de tipo pecuniarias para el Docente que no respete lo pactado, además de la prohibición de hacer uso y/o registrarse de forma permanente en nuestra plataforma.</p>
                            <p>OCTAVA: CCE no divulgará ninguna otra información sobre los alumnos a los docentes.  Es responsabilidad del Docente usar CCE de manera correcta.</p>
                            <p>NOVENA: Código de Conducta. Al utilizar los Servicios, debe comportarse de forma respetuosa en todo momento. Además, es responsable de mantener la seguridad de su cuenta y una contraseña. CCE no será responsable por las pérdidas o daños que se generen a consecuencia del incumplimiento de esta obligación. Acepta no revelar su contraseña a ningún tercero y ser el único responsable por cualquier actividad bajo su cuenta en CCE, debiendo notificar de inmediato a CCE de cualquier uso no autorizado de su cuenta.</p>
                            <p>DECIMA: El Docente no podrá elegir como nombre de usuario o contraseña palabras y/o expresiones, deberá utilizar el email declarado al momento de la inscripción.</p>
                            <p>DECIMO PRIMERA: CCE se reserva el derecho a suspender o eliminar su cuenta y su acceso al sitio, en cualquier momento, con o sin causa de aviso, si la información proporcionada durante el proceso de registro o después resulte ser inexacta, desactualizada o incompleta. CCE tiene el derecho, pero no la obligación, de supervisar toda la conducta y el contenido dictado. </p>
                            <p>DECIMO SEGUNDA: Ud. puede utilizar nuestro servicio al aceptar el cumplimiento de estos Términos y todas las leyes locales, nacionales e internacionales aplicables.</p>
                            <p>DECIMO TERCERA: Para lograr una experiencia de usuario positiva, se requieren los siguientes componentes para acceder a todos los sitios web y servicios de CCE: Sistema operativo Windows, para el Sistema de videoconferencia Google Meet, navegador Google Chrome, Internet de alta velocidad: se requiere una conexión constante. Es su responsabilidad proporcionar todo el equipo necesario para acceder a Internet y permitir las comunicaciones con los alumnos de manera correcta, como auriculares con micrófono, micrófonos y cámaras web que brinden imágenes y sonidos de alta calidad. En caso de que al momento del dictado de la clase y/o curso el Docente se vea imposibilitado de ello por razones de cualquier índole, deberá reprogramar el día y horario de lo mismos a los fines de recuperar la clase y/o curso suspendido bajo su entera responsabilidad.</p>
                            <p>DECIMO CUARTA: El Docente será el único responsable de pagar y remitir a las autoridades fiscales correspondientes todos los impuestos aplicables. En caso de que Ud. no cumpla con sus obligaciones impositivas, el Docente se compromete a defender, indemnizar y eximir a CCE de cualquier reclamo y/o responsabilidad (incluidas sanciones) como resultado del incumplimiento por parte del mismo de dichos impuestos y/o obligaciones.</p>
                            <p>DECIMO QUINTA: CCE actúa como mero intermediario en esta recepción del pago, no siendo responsable de la relación entre el Docente y el alumno. El Docente será responsable de la calidad del contenido. No obstante, CCE no es responsable de controlar el cumplimiento de dichas obligaciones. Nos reservamos el derecho a modificar en cualquier momento la comisión por los servicios con la condición de que tales cambios no tengan carácter retroactivo a los cargos pagados antes de la hora del cambio.</p>
                            <p>DECIMO SEXTA: Para solicitar el Docente la cancelación de la suscripción y la cuenta de CCE, deberá enviar un correo electrónico a info@capacitacionee.com y de ser posible explicando los motivos de su baja.</p>
                            <p>DECIMO SEPTIMA: CCE actúa como un mero intermediario entre Docentes y sus alumnos y, por tanto, no es responsable de los reclamos que se puedan producir respecto de las cancelaciones efectuadas, errores en los mismos o de la decisión del Docente de no presentarse a impartir el contenido. CCE se limitará a comprobar que el contenido se ha vendido.</p>
                            <p>DECIMO OCTAVA: En caso de que el Docente no se presente a dar un contenido o no lo entregue, este es el único responsable de realizar la devolución a los alumnos en su totalidad y el mismo se compromete a defender, indemnizar y eximir a CCE de cualquier reclamo y/o responsabilidad (incluidas sanciones).</p>
                            <p>DECIMO NOVENA: Queda terminantemente prohibido impartir cualquier contenido o comportamiento que caiga en:</p>
                            <ol>
                                <li>Discursos de odio (ataques o degradaciones a un grupo por motivos de raza, origen étnico, religión, discapacidad, género, identidad / expresión de género, edad, condición de veterano u orientación sexual).</li>
                                 <li>El comportamiento abusivo, acoso, amenazas, la intimidación, la invasión de la privacidad, la revelación de información de otras personas y/o incitar a otros a cometer actos violentos o de violar las condiciones de uso.</li>
                                <li>La actividad ilegal.</li>
                                <li>La pornografía o contenido sexual explícito, incluso si el contenido se trata de sí mismo.</li>
                                <li>Contenido con derechos de autor, a no ser que disponga de las autorizaciones necesarias.</li>
                                 <li>Violencia gráfica incluyendo, pero no limitado a, cuerpos sin vida y/o individuos heridos físicamente, siendo atacados o humillados.</li>
                            </ol>
                            <p>VIGECIMA: Sujeto a estos Términos y a nuestras Políticas de Privacidad le otorgamos a Ud. una licencia limitada, no exclusiva, intransferible y revocable para utilizar nuestro servicio. Nos reservamos el derecho de interrumpir, cambiar o cancelar cualquier aspecto del Servicio en cualquier momento. Los docentes se comprometen a utilizar el Sitio Web, Servicios, Aplicaciones y Contenidos de conformidad con la Ley, Políticas de Privacidad y los presentes Términos de Uso (y las posteriores modificaciones a las mismas), las buenas prácticas, usos y costumbres de Internet generalmente aceptadas y el orden público. El uso no autorizado de los mismos puede suponer la violación de la legislación sobre propiedad intelectual o industrial o de otras leyes aplicables, pudiendo dar lugar a la iniciación de los correspondientes procedimientos extrajudiciales o judiciales.</p>
                            <p>VIGECIMA PRIMERA: En el caso de que Ud. agregue imágenes u otro tipo de archivos a CCE  será el único responsable de que los mismos no se encuentren protegidos por derechos de autor. CCE no garantiza la confidencialidad con respecto a los datos que, de forma voluntaria, los usuarios introduzcan en CCE con independencia de que sean o no publicados. Usted manifiesta y garantiza que posee o es propietario de las licencias, derechos, consentimientos y permisos necesarios para la reproducción, distribución, transformación y comunicación pública a través de cualquier medio electrónico, en especial Internet y correo electrónico, de sus contenidos en todo el mundo y por tiempo indefinido, en los términos establecidos en los presentes Términos de Uso, incluido el derecho a autorizar a CCE a utilizarlos en la forma prevista en estas condiciones. Usted se compromete a no insertar contenido ilegal en las clases y a cumplir con toda la normativa aplicable relativa a la exhibición del contenido. </p>
                            <p>VIGECIMA SEGUNDA: Ud. reconoce que el contenido  impartido en las clases por Ud. dictadas es realizado o elaborado directamente por Usted, de forma que: 1. CCE no se hace responsable de la información contenida en su perfil y asume toda la responsabilidad por el contenido ofrecido; 2. Entiende que será públicamente ofrecido para que alumnos se registren y hasta la puedan comprar; 3. Manifiesta y garantiza que está cualificado y cuenta con las autorizaciones, títulos  y demás requisitos necesarios para impartir los contenidos y que actuará siempre de forma profesional, cumpliendo con la normativa; 4. Se compromete a no utilizar la información de sus alumnos para un propósito diferente al del contenido, salvo consentimiento previo de éstos; 5. Acepta que los alumnos puedan valorar su perfil y sus contenidos y que CCE no puede controlar dichas valoraciones y no nos hacemos responsables por las opiniones puedan incluir en dichas valoraciones.</p>
                            <p>VIGECIMA TERCERA: Tratamos de mantener CCE funcionando, seguro, sin virus y actualizado, PERO Usted lo utiliza bajo su propio riesgo. CCE no será responsable ante Usted ni ante ningún tercero por ninguna modificación, cambio de precio, suspensión o interrupción del servicio. CCE se reserva el derecho en cualquier momento y ocasionalmente de modificar o descontinuar, temporal o permanentemente, el servicio que Ud. brinda con o sin previo aviso. CCE rechaza específicamente todas las garantías y no nos hacemos responsables ni asumimos ninguna responsabilidad por cualquier contenido que Usted crea, publica y/o transmite utilizando nuestro servicio. Usted entiende y acepta que puede estar expuesto a contenido que es inexacto, incluir errores, no estar actualizado, ser ofensivo, inapropiado para niños, o de otro modo inadecuado para su propósito, y Usted renuncia a cualquier derecho o recurso que pueda tener contra CCE respecto a esto.</p>
                            <p>VIGECIMO CUARTA: CCE no otorga ninguna garantía ni se hace responsable, en ningún caso, de los daños y perjuicios de cualquier naturaleza que pudieran derivarse del acceso o uso de los contenidos de la plataforma. </p>
                            <p>VIGECIMO QUINTA: CCE  excluye cualquier responsabilidad por los daños y perjuicios de toda índole, incluyendo el lucro cesante, que pudieran deberse a los servicios prestados por los Docentes  a través del Sitio Web, a modo enunciativo y no limitativo: por los actos de competencia desleal y publicidad ilícita , así como a la falta de veracidad, exactitud, exhaustividad, vicios, defectos, pertinencia y/o actualidad de los contenidos difundidos, almacenados, recibidos, puestos a disposición o accesibles mediante los servicios prestados por terceros a través del Sitio Web. El Docente responderá de los daños y perjuicios de toda naturaleza que CCE pueda sufrir como consecuencia del incumplimiento de cualquiera de las obligaciones a las que queda sometido en virtud de los presentes Términos de Uso o de la Ley en relación con la utilización del Sitio Web. Los docentes que acceden o utilizan el servicio desde otras jurisdicciones lo hacen por su propia voluntad y son responsables de cumplir con las leyes locales. En la medida permitida por la ley aplicable, Usted acepta, en caso de violar los términos de uso o cualquier otro documento, mantener a CCE, sus afiliados, funcionarios, directores, empleados y agentes exentos de cualquier reclamación, daños, obligaciones, pérdidas, responsabilidades, costos, deudas o gastos (incluyendo los honorarios de abogados y costas) que se deriven por: (i) todos los asuntos relacionados con su uso y acceso al Servicio; (ii) su violación de cualquier término de estas Condiciones; (iii) su violación de cualquier derecho de terceros, incluyendo sin limitación, cualquier derecho de autor, propiedad o privacidad; o (iv) cualquier reclamo de que su contenido causó daños a un tercero. Esta defensa y cláusula de indemnización sobrevivirá a estos Términos y su uso del Servicio.</p>
                            <p>VIGECIMO SEXTA:  CCE podrá modificar cualquiera de estos términos y condiciones, en cualquier momento a nuestra entera discreción. Si alguna modificación es inaceptable para Usted, su único recurso es finalizar este Acuerdo. Si continúa utilizando los servicios después de haber hecho las modificaciones, indicará que Usted acepta de todos los cambios.</p>
                            <p>VIGECIMO SEPTIMA: Estos Términos y cualesquiera derechos y licencias otorgados en este documento, no podrán ser transferidos o cedidos por Usted, pero pueden ser asignados por CCE sin restricciones.</p>
                            <p>VIGECIMO OCTAVA: Los términos, condiciones y demás documentos de CCE se regirán por la legislación argentina. En caso de disputa, los tribunales competentes serán los Juzgado Civiles y Comerciales del Departamento Judicial de La Matanza. </p>
                            <p>VIGECIMO NOVENA: Al pulsar el botón Aceptar, el Docente acepta la presente Política de Privacidad y los Términos de Uso y otorga su consentimiento expreso al tratamiento automatizado de los datos personales facilitados con la finalidad de poderle prestar y ofrecer los servicios de CCE a través del sitio web. Los Docentes aceptan expresamente y de forma libre e inequívoca, que sus datos son necesarios para atender su petición y garantiza que los datos personales facilitados son veraces y se hace responsable de comunicar cualquier modificación de los mismos. El mismo queda informado y presta su consentimiento a la incorporación de sus datos en nuestra plataforma. </p>
                        </div>

                    <div>
                    <div class="form-group">
                        <label> 
                            <input type="checkbox" id="contrato" name="contrato"> 
                            Apruebo los términos del contrato.
                        </label>
                    </div>
                    

                    <button type="submit" id="Send" name="Send" class="btn btn-default">Aceptar</button>
                </form>
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
        function loaderStop()
        {
            $("#loader").hide();
        }
        
    </script>
    @yield("scripts")
</body>

</html>