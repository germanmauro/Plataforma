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
              Pagos realizados por el alumno: {{$user->nombre}} {{$user->apellido}}</h2>
          </div>
          <div class="info-clases">
            <div class="row">
              @foreach ($pagos as $item)
                  <div class="info-clases-item">
                    <h1>
                      {{$item->course->publication->titulo}} del profesor 
                      <span class="profesor">{{$item->course->publication->user->nombre}} {{$item->course->publication->user->apellido}}</span>
                        </h1>
                        <p>Tipo de curso: {{$item->course->publication->tipo}}</p>
                        @if($item->estado == "Pagado")
                          <p>Fecha pago: {{$item->fecha->format('d/m/Y H:i')}}</p>
                        @else
                          <p>Fecha vencimiento: {{$item->fechavencimiento->format('d/m/Y H:i')}}</p>
                        @endif
                        @if($item->course->cantidadcuotas>0)
                        <p>Cuota Actual: {{$item->cuota}}</p>
                        @endif
                        <p>Precio € {{$item->precio}}</p>
                        <p>Estado: <span class="infoicono">{{$item->estado}}</span></p>
                  </div>
              @endforeach
                
            </div>
            {{$pagos->links()}}
          </div>
        </div>
      </div>
    </div>
@endsection