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
    <h1>Registro exitoso - Capacitación en Español</h1>
        <img src="{{asset('image/logo.png')}}" width="180px" height="180px"/>
        <p>
            Buenos días Sr/Sra: {{$user->nombre}} {{$user->apellido}}, 
        </p>
        <p>
            Agradecemos su inscripción en nuestra plataforma C.E.E “Capacitación en español”, la cual ha sido estudiada 
            y elaborada para contribuir a su formación personal, gracias al trabajo de nuestros profesores.
        </p>
        <p>
            A la brevedad recibirá un e-mail de un miembro de C.E.E que lo invitará a participar de una entrevista
        formal a través de la plataforma Zoom, la misma tendrá como objetivo principal conocerlo, contarle 
        cuales son nuestros objetivos, de modo tal que conozca más acerca de nosotros y por último verificar
        que el sistema funcione correctamente.
        </p>
        <p>
            Si aún no lo ha hecho, lo invitamos a que descargue en su ordenador, tablet o smartphone 
            la aplicación “ZOOM”, aquí le dejamos un link para facilitar su descarga.
        </p>
        <p>
            Link: <a href="https://zoom.us/download">Descargar Zoom</a>
        </p>
        <p>
            El próximo paso es validar tu e-mail
        </p>
        <p>
            Puede hacerlo desde el siguiente 
            <a style="color:white; font-weight: bold" href="{{$cadenaverificacion}}" target="_blank">link</a>
        </p> 
        <p>
            Agradecemos su atención y le deseamos un feliz dia!!!
        </p>

        <p>
            Noelia Sabrina Arrighetti
        </p>
        <p>
            C.E.E Capacitación en español
        </p>
</body>
</html>