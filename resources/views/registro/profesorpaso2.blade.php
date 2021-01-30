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
                        <form class="formregistro" name="envio" id="envio" role="form" action="{{route("registroprofesor",$user)}}" method="post" enctype="multipart/form-data">
                            @method("put")
                            @csrf
                            <div class="error">
                                @error('terminos')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('webcam')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('especialidades')
                                    <p>{{$message}}</p>
                                @enderror
                                @error('dias')
                                    <p>{{$message}}</p>
                                @enderror
                             
                                
                            </div>
                            
                            {{-- Acá van todas las especialidades que el usuario profesor debe elegir --}}
                            <div>
                            <label>Seleccione las especialidades que desea enseñar</label>
                            @foreach ($category as $item)
                                @if(count($item->specialties)>0)
                                    <p class="category"> {{$item->nombre}} </p>
                                    <div class="specialty">
                                        @foreach ($item->specialties as $subitem)
                                               <label><input type="checkbox" name="especialidades[]" value="{{$subitem->id}}"/>  {{$subitem->nombre}} </label>
                                        @endforeach
                                    </div>
                                    
                                @endif
                            @endforeach
                            </div>
                            {{-- Acá van todas las especialidades que el usuario profesor debe elegir --}}
                            <div>
                            <label>Seleccione los días que tiene disponibles para dar clases</label>
                                    <p class="category"> DÍAS</p>
                                    <div class="specialty">
                                        @foreach ($day as $item)
                                               <label><input type="checkbox" name="dias[]" value="{{$item->id}}"/>  {{$item->nombre}} </label>
                                        @endforeach
                                    </div>
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