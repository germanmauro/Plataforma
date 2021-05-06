@extends('layouts.info')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container-fluid">
      
        <div id="curso-wrapper">
          <div class="row">  
          @foreach ($users as $item)
                <div class="col-md-4">
                  <div class="profesor-item col-md-12">
                    <div class="col-md-12">
                      @if($item->foto!="")
                        <img src="/storage/foto/{{$item->foto}}"/>
                      @else
                        <img src="{{asset('image/user.png')}}"/>
                    @endif
                        {{$item->nombre}} {{$item->apellido}}
                        <p>
                          @if($item->calificaciones()>0)
                          @for ($i = 0; $i < $item->calificaciones(); $i++)
                              <i class=" fa fa-star"></i>
                          @endfor
                          @else
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          <i class=" fa fa-star"></i>
                          {{-- Sin calificaciones --}}
                          @endif
                        </p>
                    </div>
                  </div>
                </div>
          @endforeach
          
        </div>
      </div>
  </div>

@endsection