@extends('layouts.main')
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
                    <div class="col-lg-12 box">
                        <form class="formregistro" name="envio" id="envio" role="form" action="/Registro/StoreAlumno" method="post">
                            @csrf
                            <div class="error">
                                @error('terminos')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('webcam')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('passrepeat')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('usuario')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('email')
                                    <p>{{$message}}</p>
                                @enderror
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
                                <input type="text" required class="form-control" id="direccion" name="direccion" maxlength="200" value= "{{old('direccion')}}">
                                <label>Dirección (Calle, Número, Ciudad y País)</label>
                            </div>
                            <div class="input-container">      
                                <input class="form-control" required id="tipodocumento" name="tipodocumento" maxlength="20"  value= "{{old('tipodocumento')}}">
                                <label>Tipo de Documento</label>
                            </div>
                            <div class="input-container">      
                                <input class="form-control" required id="dni" name="dni" maxlength="20"  value= "{{old('dni')}}">
                                <label>Número de Documento</label>
                            </div>
                            <div class="input-container">
                                <input type="date" required class="form-control" id="fechanacimiento" name="fechanacimiento" value= "{{old('fechanacimiento')}}">
                                <label>Fecha de Nacimiento</label>
                            </div>
                            <div class="input-container">
                                <input type="text" required class="form-control" id="telefono" name="telefono" maxlength="20"  value= "{{old('telefono')}}">
                                <label>Teléfono</label>
                            </div>
                            <div class="input-container">
                                <input type="email" required  class="form-control" name="email" id="email" maxlength="60"  value= "{{old('email')}}">
                                <label>E-Mail</label>
                            </div>
                            <div class="input-container">
                                <input required type="text" class="form-control" id="usuario" name="usuario" minlength="8" maxlength="15"  value= "{{old('usuario')}}">
                                <label>Usuario</label>
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
                                    Declaro que cuento con webcam, micrófono y conexión a internet.
                                </label>
                            </div>
                            <div class="form-group">
                                <label> 
                                    <input type="checkbox" id="terminos" name="terminos"> 
                                    <a class="formregistro" target="_blank" href="Terminos">Al registrarte aceptarás los términos y condiciones</a>
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