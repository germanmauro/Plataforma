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
              @if(count($pays)>0)
              @foreach ($pays as $item)
                  <div class="info-clases-item">
                    <p>
                      {{$item->created_at->format('d/m/Y H:i:s')}} <br>
                      Pago de cuota {{$item->buy->cuota}} del curso {{$item->buy->course->publication->titulo}} <br>
                      Alumno {{$item->buy->user->nombre}} {{$item->buy->user->apellido}} <br>
                      Profesor {{$item->user->nombre}} {{$item->user->apellido}} <br>
                      Cuenta bancario : {{$item->user->cuentabancaria}} <br>
                      Monto a transferir € {{$item->pago}} 
                      <button onclick="transferir({{$item->id}})" class="btn btn-warning" title='Marca Transferido'><span class='fas fa-hand-holding-usd'></span></button>
                    </p>
                      
                  </div>
              @endforeach
              @else
              <p class="infoicono">No tiene pagos para transferir</p>
              @endif
            </div>
            {{$pays->links()}}
          </div>
      </div>
@endsection
<script>
    //Borra imagenes
    function transferir(id) {
    swal("¿Desea marcar el monto como transferido?", {
        icon:"warning",
        buttons: {
            catch: {
                text: "SI",
                value: "catch",
            },
            cancel: "NO",
            },
        })
          .then((value) => {
                var token = '{{csrf_token()}}';
                switch (value) {
                    case "catch":
                        $.ajax
                            ({
                                
                                url: '/Pagos/SetPaid/'+id,
                                data: { _token:token },
                                type: 'post',
                                cache: false,
                                success: function (r) {
                                   location.reload();
                                }
                            });
                        break;
                }
            });    
    }
</script>