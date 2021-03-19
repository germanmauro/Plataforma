@extends('layouts.info')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix curso-encabezado">
            <h2>Detalle del curso</h2>
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
                        {{$publicacion->titulo}} <span class="curso-detalle">({{$publicacion->tipo}})</span>
                      </p>
                    </div>
                    <div class="col-md-12">
                      <p class="curso-descripcion">
                        
                       {{ $publicacion->descripcion}}
                        
                      </p>
                      <div class="col-md-12">
                        <p class="curso-profesor">
                          Por {{$publicacion->user->nombre}} {{$publicacion->user->apellido}}
                          @if($publicacion->user->calificaciones()>0)
                          {{$publicacion->user->calificaciones()}}
                          <i class=" fa fa-star"></i> de 5
                          @else
                          Sin calificaciones
                          @endif
                        </p>
                      </div>
                      <div class="col-md-12">
                        <p class="curso-detalle">
                          Precio del curso: {{$publicacion->precio}} € / Clase
                        </p>
                      </div>
                      <div class="col-md-12">
                        <p class="curso-detalle">
                          @if($publicacion->clases == 0)
                            Abono mensual : {{$publicacion->duracion}} meses           
                          @else
                            {{$publicacion->clases}} Clases
                          @endif
                        </p>
                      </div>
                      
                      @if ($publicacion->video!="")
                        <p class="curso-descripcion">
                          <a class="accionmenu" href="{{$publicacion->video}}" target="_blank">Video del curso</a>
                        </p>
                      @endif
                    </div>
                    <div class="col-md-12">
                          @if($publicacion->imagen1!="")
                            <img class="curso-image-compra" src="{{asset('storage/publicaciones/'.$publicacion->imagen1)}}" />
                          @endif
                          @if($publicacion->imagen2!="")
                            <img class="curso-image-compra" src="{{asset('storage/publicaciones/'.$publicacion->imagen2)}}" />
                          @endif
                          @if($publicacion->imagen3!="")
                            <img class="curso-image-compra" src="{{asset('storage/publicaciones/'.$publicacion->imagen3)}}" />
                          @endif
                      </div>
                      <div class="col-md-12">
                        <a class="btn btn-comprar" href="/Cursos/Comprar/{{$publicacion->id}}/{{$publicacion->slug()}}" title='Actualizar Registro' data-toggle='tooltip'> <i class='fas fa-shopping-cart'></i></span>  Comprar Curso</a>
                      </div>
                      <div class="col-md-12 curso-share">
                       @if (session()->has("Perfil") && session("Perfil")=="alumno"){{-- Solo si es alumno --}}
                          @if($publicacion->esFavorito())    
                            <a onclick="loader()" class="curso-favorite-added" href="/Cursos/RemoveFavorite/{{$publicacion->id}}" title='Agregar a favoritos'><i class='fa fa-heart'></i></a>
                          @else
                            <a onclick="loader()" class="curso-favorite" href="/Cursos/AddFavorite/{{$publicacion->id}}" title='Agregar a favoritos'><i class='fa fa-heart'></i></a>
                          @endif
                        @endif
                        
                          <a class="curso-compartir whatsapp" title="Compartir por Whatsapp" href="whatsapp://send?text=http://capacitacionee.com/Cursos/{{$publicacion->id}}/{{$publicacion->slug()}}" data-text="{{$publicacion->titulo}}" data-action="share/whatsapp/share"><i class='fab fa-whatsapp-square'></i></a>
                          <a class="curso-compartir correo" title="Compartir por email" href="mailto:?subject=Quiero compartirte este curso&amp;body=Mirá este curso {{$publicacion->titulo}} http://capacitacionee.com/Cursos/{{$publicacion->id}}/{{$publicacion->slug()}}"><i class='fas fa-envelope'></i></a>
                        
                      </div>
                  </div>
                </div>
        </div>
      </div>
@endsection