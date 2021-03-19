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
              Pagos pendientes</h2>
          </div>
          <div class="info-clases">
            <div class="row">
              @if(count($buys)>0)
              @foreach ($buys as $item)
                  <div class="info-clases-item">
                    <p>
                      {{-- Inicio{{$item->fecha->format('d/m/Y H:i')}} <br> --}}
                      Cuota {{$item->cuota}} del curso {{$item->course->publication->titulo}} <br>
                      Monto € {{$item->precio}} <br>
                      Vencimiento {{$item->fechavencimiento->format('d/m/Y H:i')}}
                    </p>
                      <a href="{{route('paypalBuy',$item)}}" class="btn btn-warning" title='Marca Transferido'>Realizar Pago <span class='fas fa-shopping-cart'></span></a>
                  </div>
              @endforeach
              @else
              <p class="infoicono">No tiene pagos pendientes</p>
              @endif
                
            </div>
            {{$buys->links()}}
          </div>
        </div>
      </div>
    </div>
@endsection