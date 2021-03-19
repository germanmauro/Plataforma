@extends('layouts.info')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Multiple Select JS -->
{{-- <link rel="stylesheet" href="{{asset('css/multiple-select.css')}}">
<script src="{{asset('js/multiple-select.js')}}"></script> --}}

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
                          (sin calificaciones)
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
                            Abono mensual : {{$publicacion->duracion}} meses (El precio mensual depende de las clases que tenga el mes).
                          @else
                            {{$publicacion->clases}} Clases
                          @endif
                          @if($primeraClase)
                          <p class="curso-detalle">
                          	¡¡Primera clase bonificada!!
                          </p>
                          @endif
                        </p>
                      </div>
                      
                    </div>
              
                       <div class="col-md-12">
                        @if(count($dias)>0) 
                        <form name="envio" id="envio" role="form" action="{{route("meeting.create",$publicacion)}}" method="POST">
                            @method("put")
                            @csrf
                            <div class="form-group">
                                @foreach ($dias as $day)
                                  <input id="{{$day->id}}" checked required type="radio" name="dia" value="{{$day->id}}"> {{$day->descripcion}} 
                                  @if($publicacion->clases == 0) - Precio primer mes <strong>€ 
                                    {{$publicacion->precio*($day->clases-$primeraClase)}} ({{$day->clases}} clases)</strong>@endif <br>
                                @endforeach 
                            </div>
                         
                        </div> 
                      <div class="col-md-12">
                        <button type="submit" id="botoncomprar" onclick="loader()" class="btn btn-comprar" href="" title='Actualizar Registro' data-toggle='tooltip'> Comprar Curso 
                          @if($publicacion->clases > 0) € {{$publicacion->precio*($publicacion->clases - $primeraClase)}} / {{$publicacion->clases}} Clases @endif
                        </button>
                        
                      </div>
                      </form>
                      @else
                        <p class="curso-descripcion">
                          Este curso ya no tiene clases disponibles. Intenta más adelante.
                        </p>
                      @endif
                  </div>
                </div>
        </div>
      </div>
@endsection