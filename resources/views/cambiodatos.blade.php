@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                DATOS DE PERFIL
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 box">
                        <form name="envio" id="envio" role="form" action="{{route("user.update",$user)}}" method="POST" enctype="multipart/form-data">
                            @method("put")
                            @csrf
                            <div class="error">
                                @error('passrepeat')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('cobro')
                                    <p>{{$message}}</p>
                                @enderror
                                
                            </div>
                            @if (session('Perfil')=="profesor")
                            <div class="form-group">
                                <label>Descripción de su perfil como profesor</label>
                                <textarea rows="6" class="form-control" minlength="50" name="descripcion" required maxlength="500" 
                                placeholder="Agregue una breve descripción de su formación académica y laboral">{{old('descripcion', $user->descripcion)}}</textarea>
                            </div>
                            @endif
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
                                <input class="form-control" required id="tipodocumento" name="tipodocumento" maxlength="20"  value= "{{old('tipodocumento',$user->tipodocumento)}}">
                                <label>Tipo de Documento</label>
                            </div>
                            <div class="input-container">      
                                <input class="form-control" required id="dni" name="dni" maxlength="12"  value= "{{old('dni',$user->dni)}}">
                                <label>Documento</label>
                            </div>
                            <div class="input-container">
                                <input type="date" required class="form-control" id="fechanacimiento" name="fechanacimiento" value= "{{old('fechanacimiento',$user->fechanacimiento->format('Y-m-d'))}}">
                                <label>Fecha de Nacimiento</label>
                            </div>
                            <div class="input-container">
                                <input type="text" required class="form-control" id="telefono" name="telefono" maxlength="20"  value= "{{old('telefono',$user->telefono)}}">
                                <label>Celular</label>
                            </div>
                            <div class="input-container">
                                <input readonly type="email"  class="form-control" name="email" id="email" maxlength="60"  value= "{{old('email',$user->email)}}">
                                <label>E-Mail</label>
                            </div>
                            @if (session('Perfil')=="profesor")
                            <h4>Complete un método cobro (Tranferencia bancaria o por Paypal)</h4><br>
                              <div class="input-container">
                                <input type="text" class="form-control" id="banco" name="banco" minlength="2" maxlength="30"  value= "{{old('banco',$user->banco)}}">
                                <label>Banco</label>
                              </div>  
                              <div class="input-container">
                                <input type="text" class="form-control" id="cbu" name="cbu" minlength="12" maxlength="30"  value= "{{old('cbu',$user->cbu)}}">
                                <label>Número de CBU</label>
                              </div>  
                              <div class="input-container">
                                <input type="text" class="form-control" id="cuentabancaria" name="cuentabancaria" minlength="12" maxlength="30"  value= "{{old('cuentabancaria',$user->cuentabancaria)}}">
                                <label>Cuenta Bancaria</label>
                              </div>  
                              <div class="input-container">
                                <input type="text" class="form-control" id="alias" name="alias" minlength="4" maxlength="30"  value= "{{old('alias',$user->alias)}}">
                                <label>Alias</label>
                              </div>  
                              <div class="input-container">
                                <input type="text" class="form-control" id="titular" name="titular" minlength="12" maxlength="30"  value= "{{old('titular',$user->titular)}}">
                                <label>Titular</label>
                              </div>
                              <div class="input-container">
                                <input type="text" class="form-control" id="paypal" name="paypal" minlength="12" maxlength="120"  value= "{{old('paypal',$user->paypal)}}">
                                <label>Paypal</label>
                              </div>
                              <div class="form-group">
                                <label>Modifcar foto de perfil.</label>
                                <input  type="file" name="foto" id="foto" accept="image/*" class="form-control">
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

                            <button  type="submit" id="Send" name="Send" class="btn btn-default">Actualizar Datos</button>
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