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
<body style="background-color: #c5c5c5; color:#1b1a1a">
    <h1>Password Reseteado con Éxito</h1>
        <img src="{{asset('image/logo.png')}}" width="180px" height="180px"/>
        <p>
            Buenos días Sr/Sra: {{$user->nombre}} {{$user->apellido}}, 
        </p>
        <p>
            ¡Su password ha sido reseteado con éxito!
        </p>
      
        <p>
            Nuevo password: {{$newpass}}<br>
            Usuario: {{$user->usuario}}
        </p>
        <p>
            Podrá modificarlo al ingresar al sistema.
        </p>
 
        <p>
            C.E.E Capacitación en español
        </p>
</body>
</html>