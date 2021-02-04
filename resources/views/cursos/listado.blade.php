@extends('layouts.main')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix">
            <h2 class="pull-left">Listado de cursos</h2>
          </div>
        </div>
      </div>
        <div id="curso-wrapper">
          <div class="row">  
          @foreach ($publicaciones as $item)
              <div class="col-md-4">
                <div class="curso-item col-md-12">
                  <div class="col-md-12">
                    <p class="curso-especialidad">
                      {{$item->specialty->nombre}} 
                    </p>
                  </div>
                  <div class="col-md-12">
                    <p class="curso-titulo">
                      {{$item->titulo}}
                    </p>
                  </div>
                  <div class="col-md-12">
                    <p class="curso-descripcion">
                      @if (strlen($item->descripcion)>100)
                      {{substr($item->descripcion,0,100)}}..
                      @else
                      {{$item->descripcion}}    
                      @endif 
                    </p>
                    <div class="col-md-12">
                      <p class="curso-profesor">
                        Por {{$item->user->nombre}} {{$item->user->apellido}}
                      </p>
                    </div>
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
                    @if ($item->video!="")
                      <a class="curso-descripcion" href="{{$item->video}}" target="_blank">Video del curso</a>
                    @endif
                  </div>
                  <div class="col-md-12">
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
                </div>
              </div>
          @endforeach
        </div>
      </div>
  </div>
@endsection