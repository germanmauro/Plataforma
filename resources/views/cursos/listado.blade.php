@extends('layouts.main')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#tabla').DataTable({
                columnDefs: [{
                   orderable: false,
                   targets: [2]
               }]}
            );
        });
</script> --}}
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix">
            <h2 class="pull-left">Listado de cursos</h2>
          </div>
        </div>
        <div id="curso-wrapper" class="col-md-12">
          
          @foreach ($publicaciones as $item)
              <div class="curso-item col-md-12">
                
                <div class="col-md-12">
                  <p class="curso-titulo">
                    {{$item->titulo}}
                  </p>
                </div>
                <div class="col-md-6">
                  <p class="curso-descripcion">
                    Descripción: {{$item->descripcion}}
                  </p>
                  <p class="curso-descripcion">
                    Duración: 
                    @if ($item->duracion=="")
                        Sin especificar
                    @else
                        {{$item->duracion}}
                    @endif
                  </p>
                  <p class="curso-descripcion">
                    Precio: {{$item->precio}} Euros
                  </p>
                  <p class="curso-descripcion">
                    Especialidad: {{$item->specialty->nombre}} 
                  </p>
                  @if ($item->video!="")
                    <a class="curso-descripcion" href="{{$item->video}}" target="_blank">Video del curso</a>
                  @endif
                </div>
                <div class="col-md-6">
                  @if ($item->imagen1!="")
                      <img class="curso-image" src="{{asset('storage/publicaciones/'.$item->imagen1)}}" alt="imagen1">
                  @endif
                  @if ($item->imagen2!="")
                      <img class="curso-image" src="{{asset('storage/publicaciones/'.$item->imagen2)}}" alt="imagen1">
                  @endif
                  @if ($item->imagen3!="")
                      <img class="curso-image" src="{{asset('storage/publicaciones/'.$item->imagen3)}}" alt="imagen1">
                  @endif
                </div>
                <div class="col-md-12">
                  <p class="curso-descripcion">
                    Curso dictado por el profesor: {{$item->user->nombre}} {{$item->user->apellido}}
                  </p>
                </div>
            </div>
          @endforeach
        </div>
          
        
      </div>
  </div>
@endsection