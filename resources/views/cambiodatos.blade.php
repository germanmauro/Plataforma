@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                REGISTRATE COMO PROFESOR PARA PODER ACCEDER A CONCRETAR CLASES CON ALUMNOS
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 box">
                        <form name="envio" id="envio" role="form" action="{{route("user.update",$user)}}" method="POST">
                            @method("put")
                            @csrf
                            <div class="error">
                                @error('passrepeat')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('email')
                                    <p>{{$message}}</p>
                                @enderror
                                
                            </div>
                            
                            <div class="input-container">      
                                <input class="form-control" required id="nombre" name="nombre" maxlength="20"  value= "{{old('nombre',$user->nombre)}}">
                                <label>Nombre</label>
                            </div>
                            <div class="input-container">
                                 <input type="text" required class="form-control" id="apellido" name="apellido" maxlength="20" value= "{{old('apellido',$user->apellido)}}">
                                <label>Apellido</label>
                            </div>
                            <div class="input-container">
                                <input type="text" required class="form-control" id="direccion" name="direccion" maxlength="200" value= "{{old('direccion',$user->direccion)}}">
                                <label>Dirección (Calle, Número, Ciudad y País)</label>
                            </div>
                            <div class="input-container">      
                                <input class="form-control" required id="dni" name="dni" maxlength="20"  value= "{{old('dni',$user->dni)}}">
                                <label>DNI</label>
                            </div>
                            <div class="input-container">
                                <input type="date" required class="form-control" id="fechanacimiento" name="fechanacimiento" value= "{{old('fechanacimiento',$user->fechanacimiento->format('Y-m-d'))}}">
                                <label>Fecha de Nacimiento</label>
                            </div>
                            <div class="input-container">
                                <input type="text" required class="form-control" id="telefono" name="telefono" maxlength="20"  value= "{{old('telefono',$user->telefono)}}">
                                <label>Teléfono</label>
                            </div>
                            <div class="input-container">
                                <input type="email" required  class="form-control" name="email" id="email" maxlength="60"  value= "{{old('email',$user->email)}}">
                                <label>E-Mail</label>
                            </div>
                            <div class="input-container">
                                <input readonly required type="text" class="form-control" id="usuario" name="usuario" minlength="8" maxlength="20"  value= "{{old('usuario',$user->usuario)}}">
                                <label>Usuario</label>
                            </div>
                            @if (session('Perfil')=="profesor")
                              <div class="input-container">
                                <input required type="text" class="form-control" id="cuentabancaria" name="cuentabancaria" minlength="12" maxlength="30"  value= "{{old('cuentabancaria',$user->cuentabancaria)}}">
                                <label>Número de CBU</label>
                            </div>  
                            @endif
                            <div class="input-container">
                                <input type="password" class="form-control" id="pass" name="pass" minlength="8" maxlength="30" value= "{{old('pass')}}">
                                <label>Contraseña (Dejar vacío para matener la misma)</label>
                            </div>
                            <div class="input-container">
                                <input type="password" class="form-control" id="passrepeat" name="passrepeat" minlength="8" maxlength="20" >
                                <label>Repetir contraseña</label>                            
                            </div>

                            <button type="submit" id="Send" name="Send" class="btn btn-default">Actualizar Datos</button>
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