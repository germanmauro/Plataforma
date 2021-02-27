@extends('layouts.info')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      <h1 class="titulo">
              NOTIFICACIÓN NUEVAS
          </h1>
    <div class="row">
    <div class="notificacion">
      @foreach ($notificaciones as $notification)
      <div class="item-notificacion">
        <p class="fecha">
          {{$notification->created_at->format('d/m/Y H:i')}}
        </p> 
        <p class="texto">
          {{$notification->tipo}}: {{$notification->texto}} 
        </p>
      </div>
      @endforeach
    </div>
    </div>

@endsection