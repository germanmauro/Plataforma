@extends('layouts.info')
@section('head')
<link rel="stylesheet" href="{{asset('css/treeview.css')}}">
{{-- <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-colors.min.css">
<link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-rtl.min.css">
<link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-icons.min.css"> --}}
<script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
@endsection
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
                    <div class="col-lg-6 box">
                        <form class="formregistro" name="envio" id="envio" role="form" action="/Registro/StoreProfesor" method="post" enctype="multipart/form-data">
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
                                <input class="form-control" required id="tipodocumento" name="tipodocumento" maxlength="20"  value= "{{old('tipodocumento',$user->tipodocumento)}}">
                                <label>Tipo de Documento</label>
                            </div>
                            <div class="input-container">      
                                <input class="form-control" required id="dni" name="dni" maxlength="12"  value= "{{old('dni',$user->dni)}}">
                                <label>Documento</label>
                            </div>
                            <div class="input-container">
                                <input type="date" required class="form-control" id="fechanacimiento" name="fechanacimiento" value= "{{old('fechanacimiento')}}">
                                <label>Fecha de Nacimiento</label>
                            </div>
                            <div class="input-container">
                                <input type="email" required  class="form-control" name="email" id="email" maxlength="60"  value= "{{old('email')}}">
                                <label>E-Mail</label>
                            </div>
                            <div class="input-container">
                                <input required type="text" class="form-control" id="usuario" name="usuario" minlength="8" maxlength="15"  value= "{{old('usuario')}}">
                                <label>Usuario</label>
                            </div>
                            <div class="form-group">
                                <label>Subir foto de perfil.</label>
                                <input required type="file" name="foto" id="foto" accept="image/*" class="form-control">
                            </div>
                            <div class="input-container">
                                <input required type="password" class="form-control" id="pass" name="pass" minlength="8" maxlength="30" value= "{{old('pass')}}">
                                <label>Contraseña</label>
                            </div>
                            <div class="input-container">
                                <input required type="password" class="form-control" id="passrepeat" name="passrepeat" minlength="8" maxlength="20" >
                                <label>Repetir contraseña</label>                            
                            </div>
                            {{-- Acá van todas las especialidades que el usuario profesor debe elegir --}}
                            <div>
                            <label>Seleccione las especialidades que desea enseñar</label>
                            <ul data-role="treeview">
                            @foreach ($category as $item)
                                @if(count($item->specialties)>0)
                                <li>
                                    <input type="checkbox" data-role="checkbox" data-caption="{{$item->nombre}}" title="">
                                    <ul>
                                        @foreach ($item->specialties as $subitem)
                                            <li><input type="checkbox" 
                                                name="especialidades[]" value="{{$subitem->id}}" 
                                                @if(is_array(old('especialidades')) && in_array($subitem->id, old('especialidades'))) checked @endif 
                                                data-role="checkbox" data-caption="{{$subitem->nombre}}" title="">
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                            @endforeach
                            </ul>
                            </div>
                            </div>
                        <div class="col-lg-6 box">
                            {{-- Acá van todas las especialidades que el usuario profesor debe elegir --}}
                            <div class="col-md-12 grillahorario">
                                <p>SELECCIONE LOS DÍAS Y HORARIOS CON DISPONIBLIDAD PARA DAR CLASES</p>
                                            @php
                                                $dias=["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"];
                                            @endphp
                                            @foreach ($dias as $day)
                                            <div class="col-md-12 day">
                                                <div class="col-md-4">
                                                    <p> 
                                                        <label>
                                                            <input type="checkbox" name="dias[]" value="{{$day}}" @if(is_array(old('dias')) && in_array($day, old('dias'))) checked @endif/> {{$day}}
                                                        </label>
                                                    </p>
                                                </div>
                                                    <div class="col-md-4">
                                                        <label>Desde</label>
                                                            <select class="form-control" name="desde{{$day}}">
                                                                @for ($i = 0; $i < 24; $i++)
                                                                    <option value="{{$i}}:00" {{ (old('desde'.$day) == $i) ? 'selected' : '' }}>{{$i}}:00 Hs</option>
                                                                @endfor
                                                            </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Hasta</label>
                                                            <select class="form-control" name="hasta{{$day}}">
                                                                @for ($i = 1; $i <= 24; $i++)
                                                                    <option value="{{$i}}:00" {{ (old("hasta".$day) == $i) ? 'selected' : '' }}>{{$i}}:00 Hs</option>
                                                                @endfor
                                                            </select>
                                                    </div>
                                            </div>
                                            @endforeach
                            </div>
                            <div class="form-group">
                                <label>Subir archivo de título (En caso de corresponder con las especialidades elegidas).</label>
                                <input type="file" name="titulo" id="titulo" accept="image/*,pdf" class="form-control">
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