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
            <h2 class="detalle"><span class="infoicono"><i class='fas fa-info-circle'></i></span> Clases del alumno {{$user->nombre}} {{$user->apellido}}</h2>
          </div>
          <div class="info-clases">
            <div class="row">
              @foreach ($buys as $item)
                  <div class="info-clases-item">
                    <h1>
                      {{$item->publication->titulo}} por 
                      <span class="profesor">{{$item->publication->user->nombre}} {{$item->publication->user->apellido}}</span>
                        </h1>
                        <p>Precio abonado {{$item->precio}} Euros</p>
                    @foreach ($item->meetings as $subitem)
                        <p>Clase N°{{$loop->iteration}} - {{$subitem->fecha->format('d/m/Y H:i')}} Estado: {{$subitem->estado}}</p>
                    @endforeach
                  </div>
              @endforeach
                
            </div>
            {{$buys->links()}}
          </div>
        </div>
      </div>
    </div>
@endsection