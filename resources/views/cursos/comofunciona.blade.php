@extends('layouts.info')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      
        <div class="comofunciona">
          <h1 class="titulo">
            ¿CÓMO FUNCIONA?
          </h1>

            
            <div class="comofunciona-item">
            <div class="comofunciona-split">
                <img src="{{asset('image/busca.jpg')}}"/>
            </div>
            <div class="comofunciona-split">
              <h2>
                Buscá tu curso
              </h2>
                <p>
                  Seleccioná los cursos que deseas aprender. CEE te da la posibilidad desde la comodidad 
                  de tu casa a capacitarte desde el lugar del mundo en donde estés, de manera personal y 
                  grupal con profesores de habla hispana.
                </p>
            </div>
            </div>

          
          
          <div class="comofunciona-item">
            
            <div class="comofunciona-split-left">
              <h2>
                Elegí los días y los horarios
              </h2>
              <p>
                Seleccioná la fecha y hora del curso que más te convenga y reserva la clase con un 
                solo click. Para días y horarios especiales contactate con nosotros.
              </p>
            </div>
            <div class="comofunciona-split-right">
              <img src="{{asset('image/dias.jpg')}}"/>
            </div>
          </div>

          <div class="comofunciona-item">
            <div class="comofunciona-split">
              <img src="{{asset('image/vivo.jpg')}}"/>
            </div>
            <div class="comofunciona-split">
              <h2>
              ¡Disfrutá de nuestras clases en vivo!
              </h2>
              <p>
                En pocos días después de la registración estarás disfrutando del curso desde la 
                comodidad de tu casa, con profesores reconocidos de habla hispana que garantizan 
                la calidad de nuestros cursos. Las clases serán grabadas para garantizar la seguridad 
                de todos.
              </p>
            </div>
          </div>

      </div>
  </div>
  

@endsection