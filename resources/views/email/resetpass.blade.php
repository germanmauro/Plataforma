<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="mygsystems">

    <title>Reseteo de Password</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css?v=5') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css?v=7') }}" rel="stylesheet">
</head>
<body style="color:#1b1a1a; padding:5px">
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

            Ingrese con su e-mail y ese nuevo password.
        </p>
        <p>
            Podrá modificarlo al ingresar al sistema.
        </p>
 
        <p>
            C.E.E Capacitación en español
        </p>
</body>
</html>