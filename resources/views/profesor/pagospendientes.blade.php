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
              Pagos Pendientes</h2>
          </div>
          <div class="info-clases">
            <div class="row">
              @if(count($pays)>0)
              @foreach ($pays as $item)
                  <div class="info-clases-item">
                    <p>
                      {{$item->updated_at->format('d/m/Y H:i:s')}} <br>
                      Pago de cuota {{$item->buy->cuota}} del curso {{$item->buy->course->publication->titulo}} <br>
                      Del alumno {{$item->buy->user->nombre}} {{$item->buy->user->apellido}} <br>
                      Monto € {{$item->pago}}

                    </p>
                      
                  </div>
              @endforeach
              @else
              <p class="infoicono">No tiene pagos pendientes</p>
              @endif
                
            </div>
            {{$pays->links()}}
          </div>
        </div>
      </div>
    </div>
@endsection