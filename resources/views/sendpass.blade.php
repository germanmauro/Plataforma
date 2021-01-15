@extends('layouts.main')

<head>
  <meta charset="UTF-8">
  <title>Ingreso al Sistema</title>

  <link rel="stylesheet" href="css/style.css">


</head>
@section('content')
 <div class="login-page">
    <div class="form">

      <form class="login-form" action="/Login/Ingreso" method="post">
        <input name="user" required type="text" maxlength=100 placeholder="Usuario (E-Mail)" />
        <input name="pass" required type="password" maxlength=15 placeholder="Contraseña" />
        <input name="formulario" value="ingreso" type="hidden" />
        <?php echo "<span class='mensaje'>" . $password_err . "</span>"; ?>
        <button>ingresar</button>

      </form>
      <a href="resetpass.php">Olvide mi contraseña</a>
    </div>

  </div>
@endsection