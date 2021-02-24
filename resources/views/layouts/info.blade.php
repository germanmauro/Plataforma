@extends('layouts.main')
@section('header')
    <div id="banner-buscador">
      <h2>Cursos personales online y en español</h2>
      <form class="buscador" action="/Cursos/Filter" method="GET">
        <input type="text" autocomplete="off" placeholder="ENCUENTRA CURSOS Y PROFESORES" name="filter">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
  <div id="menu-secundario">
    <a href="/Cursos/Categorias">Qué te gustaría aprender</a>
    <a href="">Cursos</a>
    <a href="/Info/ComoFunciona">Cómo funciona</a>
    <a href="/Info/Profesores">Nuestros profesores</a>
  </div>
 
@endsection