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
<body>
    <h1>Registro exitoso</h1>
    <p>{{$user->nombre}} gracias por registrarte en nuestra plataforma</p>
    <p>Te has registrado exitosamente en la plataforma de cursos online</p>
    <p>El próximo paso es validar tu e-mail</p>
    <p>Podes hacerlo desde el siguiente link</p>

</body>
</html>