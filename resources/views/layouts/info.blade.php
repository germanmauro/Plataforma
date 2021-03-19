@extends('layouts.main')
@section('header')
    <div id="banner-buscador">
      <h2>Clases personales y grupales online para niños y adultos</h2>
      <form class="buscador" action="/Cursos/Filter" method="GET">
        <input type="text" autocomplete="off" placeholder="ENCUENTRA CLASES Y PROFESORES" name="filter">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
  <div id="menu-secundario">
    <a href="/Cursos/Categorias"><i class='fas fa-book-reader'></i> Qué te gustaría aprender</a>
    <a href="/"><i class='far fa-lightbulb'></i> Cursos</a>
    <a href="/Info/ComoFunciona"><i class='fas fa-question'></i> Cómo funciona</a>
    <a href="/Info/Profesores"><i class='fas fa-chalkboard-teacher'></i> Nuestros profesores</a>
  </div>
 
@endsection