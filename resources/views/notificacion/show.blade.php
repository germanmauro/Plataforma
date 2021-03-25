@extends('layouts.info')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      <h1 class="titulo">
              INFORMACIÓN DE LA NOTIFICACIÓN
          </h1>
    <div class="row">
    <div class="notificacion">
      <div class="item-notificacion">
        <p class="fecha">
          {{$notification->created_at->format('d/m/Y H:i')}}
        </p> 
        <p class="texto">
          {{$notification->tipo}}: @php
            echo $notification->texto;
          @endphp
        </p>
      </div>
    </div>
    </div>

@endsection