@extends('layouts.info')
@section('head')
<link rel="stylesheet" href="{{asset('css/treeview.css')}}">
<link href="{{ asset('css/accordion.css') }}" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="{{ asset('css/DateTimePicker.css')}}">
 
@endsection
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                REGISTRATE COMO PROFESOR PARA PODER ACCEDER A CONCRETAR CLASES CON ALUMNOS <br><a href="{{asset('archivo/registro.pdf')}}" target="_blank" class='downloadlink'><span class="fa fa-info"></span> (Descargar instructivo de registro)</a>
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
                                <input type="text" data-field="date" readonly minlength="10" required class="form-control" id="fechanacimiento" name="fechanacimiento" value= "{{old('fechanacimiento'),""}}">
                                <label>Fecha de Nacimiento</label>
                            </div>
                            <div id="dtBox"></div>
                            <div class="input-container">
                                <input type="text" required class="form-control" id="telefono" name="telefono" maxlength="20"  value= "{{old('telefono')}}">
                                <label>Teléfono</label>
                            </div>
                            <div class="input-container">
                                <input type="email" required  class="form-control" name="email" id="email" maxlength="60"  value= "{{old('email')}}">
                                <label>E-Mail (Gmail recomendado)</label>
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
                            
                        </div>
                        <div class="col-lg-6 box">
                            {{-- Acá van todas las especialidades que el usuario profesor debe elegir --}}
                            <div>
                                <label>Seleccione las especialidades que desea enseñar 
                                    (Expanda cada categoría para ver las especialidades)</label>
                                <div class="col-md-6">
                                    <p>ESPECIALIDADES PARA ADULTOS</p>
                                    <div class="accordion">
                                	@foreach ($categoryadulto as $item)
                                	    @if(count($item->specialties)>0)
                                        <div class="accordion__item">
                                            <div class="accordion__item__header">
                                                {{$item->nombre}}
                                            </div>
                                            <div class="accordion__item__content">
                                            @foreach ($item->specialties as $subitem)
                                            <div>
                                                <label>
                                                    <input type="checkbox"
                                                        name="especialidades[]" value="{{$subitem->id}}"
                                                        @if(is_array(old('especialidades')) && in_array($subitem->id, old('especialidades'))) checked @endif>
                                                        {{$subitem->nombre}}
                                                </label>
                                            </div>
                                            @endforeach
                                            </div>
                                        </div>
                                	    @endif
                                	@endforeach
                                	</div>
                                </div>
                                <div class="col-md-6">
                                    <p>ESPECIALIDADES PARA NIÑOS</p>
                                	<div class="accordion">
                                	@foreach ($categoryniño as $item)
                                	    @if(count($item->specialties)>0)
                                        <div class="accordion__item">
                                            <div class="accordion__item__header">
                                                {{$item->nombre}}
                                            </div>
                                            <div class="accordion__item__content">
                                            @foreach ($item->specialties as $subitem)
                                            <div>
                                                <label>
                                                    <input type="checkbox"
                                                        name="especialidades[]" value="{{$subitem->id}}"
                                                        @if(is_array(old('especialidades')) && in_array($subitem->id, old('especialidades'))) checked @endif>
                                                        {{$subitem->nombre}}
                                                </label>
                                            </div>
                                            @endforeach
                                            </div>
                                        </div>
                                	    @endif
                                	@endforeach
                                	</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Subir archivo de título (En caso de corresponder con las especialidades elegidas).</label>
                                <input type="file" name="titulo" id="titulo" accept="image/*,pdf" class="form-control">
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
@section('scripts')
<script src="{{asset('js/accordion.js') }}"></script>
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

@endsection