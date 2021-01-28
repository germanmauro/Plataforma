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
    <h1>Registro exitoso - Capacitación en Español</h1>
    <p>{{$user->nombre}} {{$user->apellido}}, Gracias por registrarte en nuestra plataforma.</p>
    <p>Tu perfil es: {{ucfirst($user->perfil)}}</p>
    <p>El próximo paso es validar tu e-mail</p>
    <p>Podés hacerlo desde el siguiente <a style="color:white; font-weight: bold" href="{{$cadenaverificacion}}" target="_blank">link</a></p> 
    <br>
    <p>¡Muchas gracias!</p>
    <p>El equipo de Capacitación en Español</p>
</body>
</html>