@extends('layouts.info')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix curso-encabezado">
            <h2><i class="fas fa-star favorites"></i> Mis favoritos <i class="fas fa-star favorites"></i></h2>
          </div>
        </div>
      </div>
        <div id="curso-wrapper">
          <div class="row">
          @if(count($user->favorites)>0)  
          @foreach ($user->favorites as $item)
              <a href="/Cursos/{{$item->id}}/{{$item->slug()}}" class="curso-link">
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
                        <p class="curso-profesor">
                          Por {{$item->user->nombre}} {{$item->user->apellido}}
                        </p>
                      </div>
                      
                      @if ($item->video!="")
                      <div class="col-md-12">
                        <p class="curso-descripcion">
                          <a class="accionmenu" href="{{$item->video}}" target="_blank">Video del curso</a>
                        </p>
                      </div>
                      @endif
                    
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
                        <a class="btn btn-comprar" href="/Cursos/Comprar/{{$item->id}}/{{$item->slug()}}" title='Comprar curso' data-toggle='tooltip'> <i class='fas fa-money-bill'></i></span>  {{$item->precio}} € / Mes</a>
                      <div class="col-md-12 curso-share">
                        @if (session()->has("Perfil") && session("Perfil")=="alumno"){{-- Solo si es alumno --}}
                              <a class="curso-favorite-added" href="/Cursos/RemoveFavorite/{{$item->id}}" title='borrar de favoritos'><i class='fa fa-heart'></i></a>
                        @endif
                          <a class="curso-compartir" title="Compartir por Whatsapp" href="whatsapp://send?text=http://capacitacionee.com/Cursos/{{$item->id}}/{{$item->slug()}}" data-text="{{$item->titulo}}" data-action="share/whatsapp/share"><i class='fab fa-whatsapp-square'></i></a>
                          <a class="curso-compartir" title="Compartir por email" href="mailto:?subject=Quiero compartirte este curso&amp;body=Mirá este curso {{$item->titulo}} http://capacitacionee.com/Cursos/{{$item->id}}/{{$item->slug()}}"><i class='fas fa-envelope'></i></a>
                      </div>
                      
                  </div>
                </div>
              </a>
          @endforeach
          @else
          <p>
            Aún no tiene favoritos. Busque los cursos que desee y agrégelos.
          </p>
          @endif
        </div>
      </div>
  </div>
  

@endsection