<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="mygsystems">

    <title>{{$titulo}}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css?v=5') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css?v=7') }}" rel="stylesheet">
</head>
<body style="color:#1b1a1a; padding:5px">
    <h1>{{$titulo}}</h1>
        <img src="{{asset('image/logo.png')}}" width="180px" height="180px"/>
        <h3>
            @php
            echo $mensaje;
            @endphp
        </h3>

        <p>
            C.E.E Capacitación en español
        </p>
</body>
</html>