@extends('layouts.main')
@section('content')
<div class="titulo">
    Bienvenido a Capacitación en Español
    <br>
     <span class="subtitulo">La plataforma para gestionar cursos entre alumnos y profesores</span>
</div>

@if(session()->has('Perfil')&&session('Perfil')!="admin")
    @switch(session('Estado'))
        @case("registrado")
            <div class="alert alert-danger" role="alert">
                Debe validar su e-mail. Le hemos enviado un correo a su casiila. 
                Si no lo encuentra revise el spam.
            </div>
            @break
        @case("contrato a enviar")
           <div class="alert alert-danger" role="alert">
                Debe subir el contrato recibido por e-mail firmado. <a href="/Contrato/Carga" class="btn btn-default"> Cargueló aquí </a>
           </div>
            @break
        @case("a entrevistar")
           <div class="alert alert-success" role="alert">
                La administración de Capacitación en Español lo contactará vía e-mail para concretar una
                entrevista vía Zoom.
           </div>
            @break
        @case("a entrevistar")
           <div class="alert alert-success" role="alert">
                El usuario ha sido deshabilitado
           </div>
            @break
    @endswitch
@endif
@endsection