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
              Pagos del profesor: {{$user->nombre}} {{$user->apellido}}</h2>
          </div>
          <div class="info-clases">
            <div class="row">
              
                @if($totalpagar>0)
                <h3>Total a Transferir € {{$totalpagar}}
                <form action="{{route('transferirtodo',$user)}}" method="post">
                  @method("post")
                  @csrf
                  
                  <button type="submit" class="btn btn-warning" title='Marca Transferido'>Transferir todo <span class='fas fa-shopping-cart'></span></button></h3>
                </form>
                @else
                <h3>No hay dinero por transferir</h3>
                @endif
               @foreach ($pagos as $item)
                  <div class="info-clases-item">
                    <h1>
                      {{$item->buy->course->publication->titulo}} del profesor 
                      <span class="profesor">{{$item->buy->course->publication->user->nombre}} {{$item->buy->course->publication->user->apellido}}</span>
                        </h1>
                        <p>Tipo de curso: {{$item->buy->course->publication->tipo}}</p>
                        @if($item->estado == "Pagado")
                          <p>Fecha pago: {{$item->updated_at->format('d/m/Y H:i')}}</p>
                        @endif
                        {{-- @if($item->course->cantidadcuotas>0)
                        <p>Cuota Actual: {{$item->cuota}}</p>
                        @endif --}}
                        <p>Precio € {{$item->pago}}</p>
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