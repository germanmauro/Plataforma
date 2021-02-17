@extends('layouts.info')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Multiple Select JS -->
<link rel="stylesheet" href="{{asset('css/multiple-select.css')}}">
<script src="{{asset('js/multiple-select.js')}}"></script>

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
                      
                    </div>
              
                       <div class="col-md-12">
                         <form name="envio" id="envio" role="form" action="{{route("meeting.create",$publicacion)}}" method="POST">
                            @method("put")
                            @csrf
                            <div class="form-group">
                              <label for="dias"></label>
                              <select id="dias" name="dias[]" multiple>
                                @foreach ($dias as $day)
                                  <option value="{{$day->id}} ">{{$day->descripcion}} </option>
                                @endforeach 
                              </select>
                            </div>
                         
                        </div> 
                      <div class="col-md-12">
                        <button type="submit" disabled id="botoncomprar" class="btn btn-comprar" href="" title='Actualizar Registro' data-toggle='tooltip'> Elija 4 clases</button>
                      </div>
                      </form>
                  </div>
                </div>
        </div>
      </div>
<script>
  new MultipleSelect('#dias', {
    placeholder: 'Elija cuatro fechas'
})
</script>
@endsection