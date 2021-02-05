@extends('layouts.main')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix titulo">
            <h2 class="pull-left">Detalle del curso</h2>
          </div>
        </div>
      </div>
        <div id="curso-wrapper">
          <div class="row">  
                  <div class="curso-item col-md-12">
                    <div class="col-md-12">
                      <p class="curso-especialidad">
                        {{$publicacion->specialty->nombre}} 
                      </p>
                    </div>
                    <div class="col-md-12">
                      <p class="curso-titulo">
                        {{$publicacion->titulo}}
                      </p>
                    </div>
                    <div class="col-md-12">
                      <p class="curso-descripcion">
                        
                       {{ $publicacion->descripcion}}
                        
                      </p>
                      <div class="col-md-12">
                        <p class="curso-profesor">
                          Por {{$publicacion->user->nombre}} {{$publicacion->user->apellido}}
                        </p>
                      </div>
                      <p class="curso-descripcion">
                        Duración: 
                        @if ($publicacion->duracion=="")
                            Sin especificar
                        @else
                            {{$publicacion->duracion}}
                        @endif
                      </p>
                      
                      @if ($publicacion->video!="")
                        <a class="curso-descripcion" href="{{$publicacion->video}}" target="_blank">Video del curso</a>
                      @endif
                    </div>
                    <div class="col-md-12">
                          @if($publicacion->imagen1!="")
                            <img class="curso-image" src="{{asset('storage/publicaciones/'.$publicacion->imagen1)}}" />
                          @endif
                          @if($publicacion->imagen2!="")
                            <img class="curso-image" src="{{asset('storage/publicaciones/'.$publicacion->imagen2)}}" />
                          @endif
                          @if($publicacion->imagen3!="")
                            <img class="curso-image" src="{{asset('storage/publicaciones/'.$publicacion->imagen3)}}" />
                          @endif
                          </div>
                        <a class="btn btn-comprar" href="" title='Actualizar Registro' data-toggle='tooltip'> <i class='fas fa-money-bill'></i></span>  {{$publicacion->precio}} € / Mes</a>
                  </div>
                </div>
        </div>
      </div>
@endsection