@extends('layouts.main')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('css/estiloprincipal.css') }}"> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('js/bootstrap.min.js') }}"> </script> --}}
<link rel="stylesheet" href="{{asset('Tables/jquery.dataTables.css')}}">
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix">
            <h2 class="detalle"><span class="infoicono"><i class='fas fa-info-circle'></i></span>
               Listado de clases para enviar enlace de conexión a Google Meet
            </h2>
          </div>
          <div class="info-clases">
            <div class="row">
               @foreach ($days as $item)
                  <div class="info-clases-item">
                    <p>
                      Clase del día 
                      <span class="curso-icono">{{$item->fecha->format("d/m/Y")}}</span>
                       a las <span class="curso-icono">{{$item->fecha->format("H:i")}}</span>
                       Correspondiente al curso <span class="curso-icono">{{$item->course->publication->titulo}}</span>
                    </p>
                    <p><span class="curso-icono">Profesor</span> {{$item->course->publication->user->nombre}} {{$item->course->publication->user->apellido}}</p>
                    <h3 class="curso-icono">Listado de alumnos</h3>
                    @foreach ($item->course->users as $alumno)
                        <p>{{$alumno->nombre}} {{$alumno->apellido}}</p>
                    @endforeach
                    @if($item->envioenlace)
                      <p class="curso-icono">Enlace enviado</p>
                    @else
                      <div class="row">
                        <form name="envio" id="envio" role="form" action="{{route("course.sendlink",$item)}}" method="POST">
                              @method("put")
                              @csrf
                          <div class="col-lg-9">
                              <div class="form-group">
                                  {{-- <label>Monto</label> --}}
                                  <input type="text" class="form-control" required id="enlace" name="enlace" minlength=10 maxlength=1000 placeholder="Enlace a Google Meet">
                              </div>
                          </div>
                          <div class="col-lg-3">
                              <button onclick="loader()" type="submit" id="Send" name="Send" class="btn btn-default">Enviar enlace</button>
                          </div>
                            </form>
                      </div>
                    @endif
                  </div>
              @endforeach
                
            </div>
            {{$days->links()}}
          </div>
        </div>
      </div>
    </div>
@endsection