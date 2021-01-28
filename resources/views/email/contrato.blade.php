<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="mygsystems">

    <title>Registro Exitoso</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css?v=5') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css?v=7') }}" rel="stylesheet">
</head>
<body style="background-color: #474545; color:white">
    <h1>Contrato de exclusividad - Capacitación en Español</h1>
    <p>{{$user->nombre}} {{$user->apellido}}, En esta oportunidad te enviamos adjunto el contrato de exclusividad.</p>
    <p>Para terminar de habilitar tu perfil para poder operar, es necesario que descargue el archivo, lo imprimas, 
        lo firmes y luego lo escanées y lo subas a la plataforma.
    </p>
    <p>El administrador lo recibirá y luego de que lo apruebe tu perfil estará definitivamente habilitado</p> 
    <br>
    <p>¡Muchas gracias!</p>
    <p>El equipo de Capacitación en Español</p>
</body>
</html>