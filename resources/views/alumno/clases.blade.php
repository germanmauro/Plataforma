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
              Clases del alumno {{$user->nombre}} {{$user->apellido}}</h2>
          </div>
          <div class="info-clases">
            <div class="row">
              <h1>Clases del curso {{$course->publication->titulo}}</h1>
              @foreach ($buys as $item)
                  <div class="info-clases-item">
                    @if($course->cantidadcuotas>1)
                      <h3>Clases de la cuota {{$item->cuota}}</h3>
                    @endif
                     @foreach ($item->meetings as $subitem)
                        <p>Clase N°{{$loop->iteration}} - {{$subitem->fecha->format('d/m/Y H:i')}} 
                          Estado: {{$subitem->getEstado()}}
                        @if($subitem->getEstado() == "Cursada" && $subitem->calificacion == "") - Disponible para calificar
                        <div class="ec-stars-wrapper">
                          <a href="/Calificar/Meeting/{{$subitem->id}}/1" data-value="1" title="Votar con 1 estrellas">&#9733;</a>
                          <a href="/Calificar/Meeting/{{$subitem->id}}/2" data-value="2" title="Votar con 2 estrellas">&#9733;</a>
                          <a href="/Calificar/Meeting/{{$subitem->id}}/3" data-value="3" title="Votar con 3 estrellas">&#9733;</a>
                          <a href="/Calificar/Meeting/{{$subitem->id}}/4" data-value="4" title="Votar con 4 estrellas">&#9733;</a>
                          <a href="/Calificar/Meeting/{{$subitem->id}}/5" data-value="5" title="Votar con 5 estrellas">&#9733;</a>
                        </div>
                        @endif
                        @if($subitem->calificacion != "")
                         - Calificación 
                        @for ($i = 0; $i < $subitem->calificacion; $i++)
                            <i class='fas fa-star estrellas'></i>
                        @endfor
                        @endif
                        </p>
                    @endforeach
                  </div>
              @endforeach
                
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection