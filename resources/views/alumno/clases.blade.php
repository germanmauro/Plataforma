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
                        <p>Clase N°{{$loop->iteration}} - {{$subitem->fecha->format('d/m/Y H:i')}} Estado: {{$subitem->getEstado()}}</p>
                    @endforeach
                  </div>
              @endforeach
                
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection