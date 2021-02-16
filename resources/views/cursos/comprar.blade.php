@extends('layouts.info')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix curso-encabezado">
            <h2>Comprar curso: {{$publicacion->titulo}}</h2>
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
                        <p class="curso-descripcion">
                          <a class="accionmenu" href="{{$publicacion->video}}" target="_blank">Video del curso</a>
                        </p>
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
                       <div class="col-md-12">
                          <p class="curso-descripcion">
                            Disponibilidad del profesor <br>
                            @foreach ($publicacion->user->availabilities as $ava)
                              <div class="col-md-4">
                                <p class="curso-especialidad"><i class='fas fa-clock'></i> {{$ava->dia}} de: {{$ava->desde()}} hs a: {{$ava->hasta()}} hs</p>
                              </div>
                            @endforeach 
                          </p>
                        </div> 
                      <div class="col-md-12">
                        <a class="btn btn-comprar" href="" title='Actualizar Registro' data-toggle='tooltip'> <i class='fas fa-money-bill'></i></span>  {{$publicacion->precio}} € / Mes (4 clases)</a>
                      </div>
                      <div class="col-md-12 curso-share">
                        @if (session()->has("Perfil") && session("Perfil")=="alumno"){{-- Solo si es alumno --}}
                            <a class="curso-favorite" title='Agregar a favoritos'><i class='fa fa-heart'></i></a>
                        @endif
                        <div>
                          <a class="curso-compartir" title="Compartir por Whatsapp" href="whatsapp://send?text=http://capacitacionee.com/Cursos/{{$publicacion->id}}/{{$publicacion->slug()}}" data-text="{{$publicacion->titulo}}" data-action="share/whatsapp/share"><i class='fab fa-whatsapp-square'></i></a>
                          <a class="curso-compartir" title="Compartir por email" href="mailto:?subject=Quiero compartirte este curso&amp;body=Mirá este curso {{$publicacion->titulo}} http://capacitacionee.com/Cursos/{{$publicacion->id}}/{{$publicacion->slug()}}"><i class='fas fa-envelope'></i></a>
                        </div>
                      </div>
                  </div>
                </div>
        </div>
      </div>
@endsection