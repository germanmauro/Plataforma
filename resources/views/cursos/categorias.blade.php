@extends('layouts.info')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      
        <div id="curso-wrapper">
          @foreach ($categorias as $item)
              <a href="/Cursos/Categoria/{{$item->id}}/{{$item->slug()}}" class="curso-link">
                  <div class="categoria-item">
                      @if ($item->imagen!="")
                        <img height="60px" src="{{asset('storage/categorias/'.$item->imagen)}}">
                      @else
                        <img height="60px" src="{{asset('image/category.png')}}">
                      @endif
                      <br>
                        {{$item->nombre}} 
                    </div>
              </a>
          @endforeach
          
      </div>
  </div>
  

@endsection