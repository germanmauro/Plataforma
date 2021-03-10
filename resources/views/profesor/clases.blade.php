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
               Clases del curso {{$course->publication->titulo}}</h2>
          </div>
          <div class="info-clases">
            <div class="row">
                  <div class="info-clases-item">
                     @foreach ($days as $item)
                        <p>Clase N°{{$loop->iteration}} - {{$item->fecha->format('d/m/Y H:i')}} Estado: {{$item->getEstado()}}</p>
                    @endforeach
                  </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection