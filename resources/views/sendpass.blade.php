@extends('layouts.main')

<head>
  <meta charset="UTF-8">
  <title>Ingreso al Sistema</title>

  <link rel="stylesheet" href="{{asset('css/style.css?v=3')}}">


</head>
@section('content')
 <div class="login-page">
    <div class="form">

      <form class="login-form" action="/Login/Resetear" method="post">
        @csrf
        <label for="email">Ingrese su email para que le enviemos su nueva contraseña</label>
        <input name="email" required type="email" maxlength=100 placeholder="Ingrese su e-mail" />
        @error('email')
            <span class='mensaje'>{{$message}}</span>
        @enderror
   
        <button>Resetear Password</button>

      </form>
      
    </div>

  </div>
@endsection