@extends('layouts.info')
@section('head')
 <link rel="stylesheet" type="text/css" href="{{ asset('css/DateTimePicker.css')}}">
@endsection
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                REGISTRATE COMO ALUMNO PARA PODER ACCEDER A CONCRETAR CLASES CON PROFESORES
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6 box">
                        <form class="formregistro" name="envio" id="envio" role="form" action="/Registro/StoreAlumno" method="post">
                            @csrf
                            <div class="error">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                            
                            <div class="input-container">      
                                <input class="form-control" required id="nombre" name="nombre" maxlength="20"  value= "{{old('nombre')}}">
                                <label>Nombre</label>
                            </div>
                            <div class="input-container">
                                 <input type="text" required class="form-control" id="apellido" name="apellido" maxlength="20" value= "{{old('apellido')}}">
                                <label>Apellido</label>
                            </div>
                            <div class="input-container">
                                <input type="text" data-field="date" readonly required class="form-control" id="fechanacimiento" name="fechanacimiento" value= "{{old('fechanacimiento')}}">
                                <label>Fecha de Nacimiento</label>
                            </div>
                            <div id="dtBox"></div>
                            <div class="input-container">
                                <input type="text" required class="form-control" id="telefono" name="telefono" maxlength="20"  value= "{{old('telefono')}}">
                                <label>Celular</label>
                            </div>
                        </div>
                        <div class="col-lg-6 box">     
                            <div class="input-container">
                                <input type="email" required  class="form-control" name="email" id="email" maxlength="60"  value= "{{old('email')}}">
                                <label>E-Mail (Gmail recomendado)</label>
                            </div>
                            <div class="input-container">
                                <input required type="password" class="form-control" id="pass" name="pass" minlength="8" maxlength="30" value= "{{old('pass')}}">
                                <label>Contraseña</label>
                            </div>
                            <div class="input-container">
                                <input required type="password" class="form-control" id="passrepeat" name="passrepeat" minlength="8" maxlength="20" >
                                <label>Repetir contraseña</label>                            
                            </div>
                            <div class="form-group">
                                <label> 
                                    <input type="checkbox" id="webcam" name="webcam"> 
                                    Cuento con micrófono y conexión a internet.
                                </label>
                            </div>
                            <div class="form-group">
                                <label> 
                                    <input type="checkbox" id="terminos" name="terminos"> 
                                        Al registrarte aceptarás los 
                                        <a class="formregistro" target="_blank" href="Terminos">
                                            Términos y condiciones</a>
                                            y las
                                        <a class="formregistro" target="_blank" href="/PoliticaPrivacidad">
                                            Políticas de privacidad</a>
                                </label>
                            </div>

                            <button type="submit" id="Send" name="Send" class="btn btn-default">Confirmar Registro</button>
                        </form>
                    </div>

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection
@section('scripts')
<script src="{{asset('js/DateTimePicker.js') }}"></script>
<script>
$(document).ready(function()
 {
     $("#dtBox").DateTimePicker(
         {
             dateTimeFormat: 'd-m-Y'
         }
     );
 });
</script>
@endsection