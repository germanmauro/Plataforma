@extends('layouts.info')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      {{-- Info de la categoria --}}
          <div class="categoriainfo">
            <div class="categoriainfo-item">
              <div class="categoriainfo-split-left">
                <h2>
                  {{$categoria->nombre}}
                </h2>
                <p>
                  @php
                  echo $categoria->texto;
                  @endphp
                </p>
              </div>
              <div class="categoriainfo-split-right">
                <img src="{{asset('storage/categorias/'.$categoria->imagen)}}"/>
              </div>
            </div>
          </div>
        <div id="curso-wrapper">      
          <div class="row">  
          @foreach ($publicaciones as $item)
              <a href="/Cursos/{{$item->id}}/{{$item->slug()}}" class="curso-link">
                <div class="col-md-3 col-sm-6">
                  <div class="curso-item col-md-12">
                    <div>
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
                      <p class="curso-detalle">
                        {{$item->specialty->nombre}} 
                      </p>
                    </div>
                    <div class="col-md-12">
                      <p class="curso-titulo">
                        {{$item->titulo}} <span class="curso-detalle">({{$item->tipo}})</span>
                      </p>
                    </div>
                      <div class="col-md-12">
                        <p class="curso-profesor">
                          Por {{$item->user->nombre}} {{$item->user->apellido}}
                          <br>
                          @if($item->user->calificaciones()>0)
                          {{$item->user->calificaciones()}}
                          @for ($i = 0; $i < $item->user->calificaciones(); $i++)
                              <i class=" fa fa-star"></i>
                          @endfor
                          @else
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          {{-- (sin calificaciones) --}}
                          @endif
                        </p>
                      </div>
                      <div class="col-md-12">
                        <p class="curso-detalle">Destinado a {{$item->specialty->category->destinatario}}</p>
                      </div>
                      @if ($item->video!="")
                      <div class="col-md-12">
                        <p class="curso-descripcion">
                          <a class="accionmenu" href="{{$item->video}}" target="_blank">Video del curso</a>
                        </p>
                      </div>
                      @endif
                      <div class="col-md-12">
                        <p class="curso-detalle">
                          Precio del curso: {{$item->precio}} € / Clase
                        </p>
                        <p class="curso-detalle">
                          {{$item->primerDiaDisponible()}}
                        </p>
                      </div>
                      <div class="col-md-12">
                        <p class="curso-detalle">
                          @if($item->clases == 0)
                            Abono mensual : {{$item->duracion}} meses           
                          @else
                            {{$item->clases}} Clases
                          @endif
                        </p>
                      </div>
                    
                    
                        <a class="btn btn-comprar" href="/Cursos/Comprar/{{$item->id}}/{{$item->slug()}}" title='Comprar curso' data-toggle='tooltip'> <i class='fas fa-money-bill'></i></span>  Comprar Curso </a>
                      <div class="col-md-12 curso-share">
                        @if (session()->has("Perfil") && session("Perfil")=="alumno"){{-- Solo si es alumno --}}
                          @if($item->esFavorito())    
                            <a onclick="loader()" class="curso-favorite-added" href="/Cursos/RemoveFavorite/{{$item->id}}" title='Agregar a favoritos'><i class='fa fa-heart'></i></a>
                          @else
                            <a onclick="loader()" class="curso-favorite" href="/Cursos/AddFavorite/{{$item->id}}" title='Agregar a favoritos'><i class='fa fa-heart'></i></a>
                          @endif
                        @endif
                          <a class="curso-compartir whatsapp" title="Compartir por Whatsapp" href="whatsapp://send?text=http://capacitacionee.com/Cursos/{{$item->id}}/{{$item->slug()}}" data-text="{{$item->titulo}}" data-action="share/whatsapp/share"><i class='fab fa-whatsapp-square'></i></a>
                          <a class="curso-compartir correo" title="Compartir por email" href="mailto:?subject=Quiero compartirte este curso&amp;body=Mirá este curso {{$item->titulo}} http://capacitacionee.com/Cursos/{{$item->id}}/{{$item->slug()}}"><i class='fas fa-envelope'></i></a>
                      </div>
                      
                  </div>
                </div>
              </a>
          @endforeach
          
        </div>
        {{$publicaciones->links()}}
      </div>
  </div>
  

@endsection