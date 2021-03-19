@extends('layouts.info')
@section('content')
{{-- <h1 class="titulo">
    NOSOTROS
</h1> --}}
<div class="container-fluid">
	<div class="categoriainfo">
	    <div class="categoriainfo-item">
	        <div class="categoriainfo-split-left">
	        <h2>
	            Acerca de nosotros
	        </h2>
	        <p>
	            Somos una empresa familiar, que tiene como objetivo brindar cursos infividuales y grupales online en español,
	                para que todas las personas, niños, adolescentes y adultos, puedan capacitarse desde la comodidad de su casa 
                    con material de alta calidad. 
                    <br>
                    Nos apasiona el desarrollo humano como fuente de progreso. 
                    En estos tiempos que corren, para no quedar fuera del sistema, entendimos que es imprescindible la
                    capacitación constante. Por eso decidimos crear C.E.E “Capacitación en español” que ofrece las
                    herramientas necesarias a niños, adolescentes y adultos para su crecimiento personal.
                </p>
	        </div>
	        <div class="categoriainfo-split-right">
	        <img src="{{asset('image/nosotros.jpg')}}">
	        </div>
	    </div>
	</div>
</div>
<div class="nosotros">
    <div class="imagen-nosotros">
        
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="item-nosotros">
                <h2>
                    <i class="fas fa-user-graduate"></i>
                </h2>
                <h2>
                    Nuestros Cursos
                </h2>
                <p>
                    Para lograr que nuestro material sea de alta calidad, contamos con un equipo de asesores en el 
                    ámbito educativo internacional
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="item-nosotros">
                <h2>
                    <i class="fas fa-chalkboard-teacher"></i>
                </h2>
                <h2>
                    Nuestros profesores
                </h2>
                <p>
                    Son reconocidos en el ámbito educativo, dominan la metodología online y brindan cursos 
                    de altísima calidad para lograr resultados extraordinarios en los alumnos.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="item-nosotros">
                <h2>
                    <i class="fas fa-chart-bar"></i>
                </h2>
                <h2>
                    Nuestra Misión
                </h2>
                <p>
                    Conectamos Alumnos de todo el mundo con profesores prestigiosos de habla hispana, para que el 
                    idioma no sea un impedimento, sino una herramienta fundamental que acreciente los objetivos de aprendizaje.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="item-nosotros">
                <h2>
                    <i class="fas fa-chart-area"></i>
                </h2>
                <h2>
                    Nuestra Visión
                </h2>
                <p>
                    Aspiramos a ser una alternativa educativa, ofreciendo un nuevo modelo de aprendizaje basado en 
                    la calidad, veracidad y la personalización de contenidos.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection