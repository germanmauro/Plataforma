@extends('layouts.main')

<head>
  <meta charset="UTF-8">
  <title>Ingreso al Sistema</title>

  <link rel="stylesheet" href="css/style.css?v=3">

</head>
@section('content')
 <div class="login-page">
    <div class="form">

      <form class="login-form" action="/Login/Ingreso" method="post">
        @csrf
        <input name="email" required type="email" maxlength=100 placeholder="E-mail" />
        <input name="pass" required type="password" maxlength=15 placeholder="Contraseña" />
        <input name="formulario" value="ingreso" type="hidden" />
        @error('usuario')
            <span class='mensaje'>{{$message}}</span>
        @enderror
        @error('password')
            <span class='mensaje'>{{$message}}</span>
        @enderror
        <button>ingresar</button>

      </form>
      <a href="/ResetPass">Recuperar contraseña</a>
    </div>

  </div>
@endsection