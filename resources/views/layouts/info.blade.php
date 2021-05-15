@extends('layouts.main')
@section('header')
    <div id="banner-buscador">
      <h2>Clases personales y grupales online para niños y adultos</h2>
      <form class="buscador" action="/Cursos/Filter" method="GET">
        <input type="text" autocomplete="off" placeholder="ENCUENTRA CLASES O CURSOS" name="filter">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    
  <div id="menu-secundario">
    <ul class="nav" id="side-menu2">
      <li>
        <a href="#"><i class='fas fa-book-reader'></i> Qué te gustaría aprender</a>
        <ul class='nav nav-second-level'>
            <li>
                <a  href='/Cursos/Categorias/Adultos'> <i class='fas fa-user-tie'></i> Adultos</a>
            </li>
            <li>
                <a  href='/Cursos/Categorias/Niños'> <i class='fas fa-child'></i> Niños</a>
            </li>
        </ul>
      </li>
      <li>
        <a href="/"><i class='far fa-lightbulb'></i> Cursos</a>
      </li>
      <li>
        <a href="/Info/ComoFunciona"><i class='fas fa-question'></i> Cómo funciona</a>
      </li>
      <li>
        <a href="/Info/Profesores"><i class='fas fa-chalkboard-teacher'></i> Nuestros profesores</a>
      </li>   
    </ul>
    
  </div>
 <div>
      <img class="sub-banner" src="{{asset('image/banner.png')}}" alt="CEE"/>
    </div>
@endsection