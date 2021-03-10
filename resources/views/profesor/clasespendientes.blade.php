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
              Mis cursos activos</h2>
          </div>
          <div class="info-clases">
            <div class="row">
              @foreach ($clases as $item)
                  <div class="info-clases-item">
                    <h1>
                      {{$item->publication->titulo}} del profesor 
                      <span class="profesor">{{$item->publication->user->nombre}} {{$item->publication->user->apellido}}</span>
                        </h1>
                        <p>Tipo de curso: {{$item->publication->tipo}}</p>
                        <p>Inicio: {{$item->inicio->format('d/m/Y H:i')}}</p>
                        @if($item->cantidadcuotas>0)
                        <p>Cantidad de Cuotas: {{$item->cantidadcuotas}}</p>
                        <p>Cuota Actual: {{$item->cuotaactual}}</p>
                        <p>Cuotas restantes: {{$item->cantidadcuotas - $item->cuotaactual}}</p>
                        @else
                        <p>Cantidad de clases: {{$item->cantidadclases}}</p>
                        @endif
                        @if(count($item->users)>0)
                        <h3>Alumnos inscriptos al curso</h3>
                        <p>
                          @foreach ($item->users as $usuario)
                            <i class='fas fa-user'></i> {{$usuario->nombre}} {{$usuario->apellido}}
                          @endforeach
                        </p>
                        @else
                        <p class="infoicono">No tiene alumnos inscriptos</p>
                        @endif
                        
                        <a class="accionmenu" href="/Profesor/Clases/{{$item->id}}">Ver Clases del curso</a>
                  </div>
              @endforeach
                
            </div>
            {{-- {{$clases->links()}} --}}
          </div>
        </div>
      </div>
    </div>
@endsection