@extends('layouts.main')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix curso-encabezado">
            <h2>Listado de cursos</h2>
          </div>
        </div>
      </div>
        <div id="curso-wrapper">
          <div class="row">  
          @foreach ($publicaciones as $item)
              <a href="/Cursos/{{$item->id}}" class="curso-link">
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
                      
                      @if ($item->video!="")
                        <p class="curso-descripcion">
                          <a class="accionmenu" href="{{$item->video}}" target="_blank">Video del curso</a>
                        </p>
                      @endif
                    </div>
                    <div class="col-md-12">
                      @if ($item->firstImage()!="")
                          <img class="curso-image" 
                          @switch($item->firstImage())
                              @case("1")
                                  src="{{asset('storage/publicaciones/'.$item->imagen1)}}"
                                  @break
                              @case("2")
                                  src="{{asset('storage/publicaciones/'.$item->imagen2)}}"
                                  @break
                              @case("3")
                                  src="{{asset('storage/publicaciones/'.$item->imagen3)}}"
                                  @break
                              @default
                                  
                          @endswitch
                          
                          />     
                      @endif                  
                    </div>
                    <div class="col-md-12">
                        @php 
                        
                        @endphp
                      </div>
                        <a class="btn btn-comprar" href="" title='Actualizar Registro' data-toggle='tooltip'> <i class='fas fa-money-bill'></i></span>  {{$item->precio}} € / Mes</a>
                  </div>
                </div>
              </a>
          @endforeach
        </div>
      </div>
  </div>
@endsection