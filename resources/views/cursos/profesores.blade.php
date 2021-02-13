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
                    @endif
                        {{$item->nombre}} {{$item->apellido}} 
                    </div>
                  </div>
                </div>
          @endforeach
          
        </div>
      </div>
  </div>
  

@endsection