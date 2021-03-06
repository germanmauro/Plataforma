@extends('layouts.main')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('css/estiloprincipal.css') }}"> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('js/bootstrap.min.js') }}"> </script> --}}
<link rel="stylesheet" href="{{asset('Tables/jquery.dataTables.css')}}">
<div class="container-fluid">
      <div class="row">
          <div class="page-header clearfix">
            <h2 class="detalle"><span class="infoicono"><i class='fas fa-info-circle'></i></span> 
              Pagos recibidos</h2>
          </div>
      </div>
          <div class="info-clases">
            <div class="row">
              @if(count($buys)>0)
              @foreach ($buys as $item)
                  <div class="info-clases-item">
                    <p>
                      {{$item->updated_at->format('d/m/Y H:i:s')}} <br>
                      Pago de cuota {{$item->cuota}} del curso {{$item->course->publication->titulo}} <br>
                      Abonado por el alumno {{$item->user->nombre}} {{$item->user->apellido}} <br>
                      Monto cobrado € {{$item->precio}} <br>
                      Monto para el profesor € {{$item->teacher_pay->pago}} 
                      <span class="infoicono">
                        @if($item->teacher_pay->estado == "Pagado")
                        (Transferido)
                        @else
                        (A transferir)
                        @endif
                      </span>
                      <br> 
                      Comisión cobrada € {{$item->montoadministrador}} 

                    </p>
                      
                  </div>
              @endforeach
              @else
              <p class="infoicono">No tiene pagos recibidos</p>
              @endif
            </div>
            {{$buys->links()}}
          </div>
      </div>
@endsection