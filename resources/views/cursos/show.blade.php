@extends('layouts.info')
@section('content')
<link href="{{ asset('css/accordion.css') }}" rel="stylesheet">

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
                        {{$publicacion->titulo}} <br><span class="curso-detalle">({{$publicacion->tipo}})</span>
                      </p>
                    </div>
                    <div class="col-md-12">
                        <p class="curso-profesor">
                          Por {{$publicacion->user->nombre}} {{$publicacion->user->apellido}}
                          <br>
                          @if($publicacion->user->calificaciones()>0)
                          @for ($i = 0; $i < $publicacion->user->calificaciones(); $i++)
                              <i class=" fa fa-star"></i>
                          @endfor
                          @else
                          {{-- (sin calificaciones) --}}
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          @endif
                        </p>
                      </div>
                    <div class="col-md-12">
                      <p class="curso-descripcion">
                       {{ $publicacion->descripcion}}
                      </p>
                    </div>
                      
                      <div class="col-md-12">
                        <h3 class="curso-info">¿Por qué debería realizar este curso?</h3>
                        <div class="accordion">
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                Temas que veré en el curso
                              </div>
                              <div class="accordion__item__content">
                                 {!! nl2br(e($publicacion->temas)) !!}
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Qué beneficios obtendré con este curso?
                              </div>
                              <div class="accordion__item__content">
                                 {!! nl2br(e($publicacion->beneficios)) !!}
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Qué aprenderé en el curso?
                              </div>
                              <div class="accordion__item__content">
                                 {!! nl2br(e($publicacion->aprendizaje)) !!}
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                      
                          @foreach ($dias as $item)
                              <div class="curso-info-profesor">
                                <p class="curso-detalle">
                                    Inicio {{$item->inicio->format("d/m/Y")}}
                                    {{-- Fin {{$item->ultimaclase->format("d/m/Y")}} --}}
                                     - Días 
                                     @switch($item->inicio->format("l"))
                                         @case("Monday")
                                             Lunes
                                             @break
                                         @case("Tuesday")
                                             Martes
                                             @break
                                         @case("Wednesday")
                                             Miércoles
                                             @break
                                         @case("Thursday")
                                             Jueves
                                             @break
                                         @case("Friday")
                                             Viernes
                                             @break
                                         @case("Saturday")
                                             Sábado
                                             @break
                                         @case("Sunday")
                                             Domingo
                                             @break
                                         @default
                                             
                                     @endswitch
                                      
                                     <img src="{{asset('image/italia.png')}}" width="25px" alt="Italia" title="Italia"> {{$item->inicio->format("H:i")}} 
                                     <img src="{{asset('image/argentina.png')}}" width="25px" alt="Argentina" title="Argentina"> {{$item->inicio->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'))->format("H:i")}} 
                                     <img src="{{asset('image/usa.png')}}" width="25px" alt="USA" title="New York/Miami"> {{$item->inicio->setTimezone(new DateTimeZone('America/New_York'))->format("H:i")}} 
                                    </p>
                                    </div>
                          @endforeach
                        
                      </div>
                      <div class="col-md-12">
                        <p class="curso-detalle"><span class="curso-icono"><i class="fas fa-birthday-cake"></i></span> Edad: {{$publicacion->specialty->category->destinatario}}</p>
                      </div>
                      <div class="col-md-12">
                        <p class="curso-detalle"><span class="curso-icono"><i class="fas fa-weight"></i></span> Nivel: {{$publicacion->nivel}}
                         @switch($publicacion->nivel)
                             @case("Principiante")
                                 <span class="curso-icono"><i class="fas fa-battery-quarter"></i></span>
                                 @break
                             @case("Intermedio")
                                 <span class="curso-icono"><i class="fas fa-battery-half"></i></span>
                                 @break
                             @case("Avanzado")
                                 <span class="curso-icono"><i class="fas fa-battery-full"></i></span>
                                 @break
                             @default
                                 
                         @endswitch</p>
                        @if($publicacion->tipo == "Grupal" && $publicacion->alumnos >1)
                          <p class="curso-detalle">
                            <span class="curso-icono"><i class="fas fa-users"></i></span>
                            Cantidad mímina de alumnos: 
                              {{$publicacion->alumnos}}         
                          </p>
                        @endif
                        <p class="curso-detalle">
                          <span class="curso-icono"><i class="fas fa-euro-sign"></i></span>
                          Precio del curso: {{$publicacion->precio}} € / Clase
                        </p>
                      
                        <p class="curso-detalle">
                          <span class="curso-icono"><i class="fas fa-clock"></i></span>
                           Duración clase: 
                          60 min
                        </p>
                        <p class="curso-detalle">
                          <span class="curso-icono"><i class="fas fa-calendar"></i></span>
                           Duración curso: 
                          @if($publicacion->clases == 0)
                            {{$publicacion->duracion}} meses (Abono mensual)           
                          @else
                            {{$publicacion->clases}} Clases
                          @endif
                        </p>
                      </div>
                      @if ($publicacion->video!="")
                      <div class="col-md-12">
                        <p class="curso-descripcion">
                          <a class="accionmenu" href="{{$publicacion->video}}" target="_blank">Video del curso</a>
                        </p>
                      </div>
                     @endif
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
                        <h3 class="curso-info">Requisitos</h3>
                        <p class="curso-requisito"><span class="curso-icono"><i class='fas fa-desktop'></i></span> Computadora </p> 
                        <p class="curso-requisito"><span class="curso-icono"><i class='fas fa-wifi'></i></span> Conexión a internet </p>
                        <p class="curso-requisito"><span class="curso-icono"><i class='fas fa-microphone'></i></span> Micrófono </p>
                        <p class="curso-requisito"><span class="curso-icono"><i class='fas fa-camera'></i></span> Webcam </p> 
                      </div>
                      <div class="col-md-12 curso-info-profesor">
                        <div class="col-md-4">
                          <h3 class="curso-info-center">Profesor</h3>
                           @if($publicacion->user->foto!="")
                              <img class="curso-profesor-img" src="/storage/foto/{{$publicacion->user->foto}}"/>
                            @else
                              <img class="curso-profesor-img" src="{{asset('image/user.png')}}"/>
                            @endif
                        </div>
                        <div class="col-md-8">
                          <h3 class="curso-info-profesor">{{$publicacion->user->nombre}} {{$publicacion->user->apellido}}</h3>
                          <p class="curso-detalle">{{$publicacion->user->descripcion}}</p>
                          <p class="curso-detalle">
                          @if($publicacion->user->calificaciones()>0)
                            {{$publicacion->user->calificaciones()}}
                          @for ($i = 0; $i < $publicacion->user->calificaciones(); $i++)
                              <i class=" fa fa-star"></i>
                          @endfor
                          @else
                           <i class="curso-icono fa fa-star"></i>
                           <i class="curso-icono fa fa-star"></i>
                           <i class="curso-icono fa fa-star"></i>
                           <i class="curso-icono fa fa-star"></i>
                           <i class="curso-icono fa fa-star"></i>
                          @endif  
                          </p>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <h3 class="curso-info">Preguntas Frecuentes</h3>
                        <div class="accordion">
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cómo funcionan las clases?
                              </div>
                              <div class="accordion__item__content">
                                 Las clases se realizan a través de Google Meet. C.E.E se encarga de conectar a los alumnos con 
                                 los profesores enviando el link de cada reunión via e-mail. Google Meet ofrece herramientas de gestión, 
                                 para que cada clase sea satifactoria. Todas las clases serán grabadas para la seguridad de todos. 
                              </div>
                          </div>
                        </div>
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
      
    <script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/accordion.js') }}"></script>
@endsection