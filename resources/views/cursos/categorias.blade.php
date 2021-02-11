@extends('layouts.info')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      
        <div id="curso-wrapper">
          <div class="row">  
          @foreach ($categorias as $item)
              <a href="/Cursos/Categoria/{{$item->id}}/{{$item->slug()}}" class="curso-link">
                <div class="col-md-4">
                  <div class="categoria-item col-md-12">
                    <div class="col-md-12">
                        {{$item->nombre}} 
                    </div>
                  </div>
                </div>
              </a>
          @endforeach
          
        </div>
      </div>
  </div>
  

@endsection