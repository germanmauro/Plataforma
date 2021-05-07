@extends('layouts.info')
@section('head')
<link rel="stylesheet" href="{{asset('css/treeview.css')}}">
<link href="{{ asset('css/accordion.css') }}" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="{{ asset('css/DateTimePicker.css')}}">
 
@endsection
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Espacialidades del profesor {{$user->nombre}} {{$user->apellido}}</a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6 box">
                        <form class="formregistro" name="envio" id="envio" role="form" action="{{route("specialty.update",$user)}}" method="post">
                            @method("put")
                            @csrf
                            <div class="error">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                            
                                                    </div>
                        <div class="col-lg-12 box">
                            {{-- Acá van todas las especialidades que el usuario profesor debe elegir --}}
                            <div>
                                <div class="col-md-6">
                                    <p>ESPECIALIDADES PARA ADULTOS</p>
                                    <div class="accordion">
                                	@foreach ($categoryadulto as $item)
                                	    @if(count($item->specialties)>0)
                                        <div class="accordion__item">
                                            <div class="accordion__item__header">
                                                {{$item->nombre}}
                                            </div>
                                            <div class="accordion__item__content">
                                            @foreach ($item->specialties as $subitem)
                                            <div>
                                                <label>
                                                    <input type="checkbox"
                                                        name="especialidades[]" value="{{$subitem->id}}"
                                                        @if(in_array($subitem->id, $user->specialties->pluck("id")->toArray())) checked @endif
                                                        > 
                                                        {{$subitem->nombre}}
                                                </label>
                                            </div>
                                            @endforeach
                                            </div>
                                        </div>
                                	    @endif
                                	@endforeach
                                	</div>
                                </div>
                                <div class="col-md-6">
                                    <p>ESPECIALIDADES PARA NIÑOS</p>
                                	<div class="accordion">
                                	@foreach ($categoryniño as $item)
                                	    @if(count($item->specialties)>0)
                                        <div class="accordion__item">
                                            <div class="accordion__item__header">
                                                {{$item->nombre}}
                                            </div>
                                            <div class="accordion__item__content">
                                            @foreach ($item->specialties as $subitem)
                                            <div>
                                                <label>
                                                    <input type="checkbox"
                                                        name="especialidades[]" value="{{$subitem->id}}"
                                                        @if(in_array($subitem->id, $user->specialties->pluck("id")->toArray())) checked @endif                                                        >
                                                        {{$subitem->nombre}}
                                                </label>
                                            </div>
                                            @endforeach
                                            </div>
                                        </div>
                                	    @endif
                                	@endforeach
                                	</div>
                                </div>
                            </div>
                        </div>
                            
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Actualizar especialidades</button>
                        </form>
                    </div>

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@section('scripts')
<script src="{{asset('js/accordion.js') }}"></script>
<script src="{{asset('js/DateTimePicker.js') }}"></script>
<script>
$(document).ready(function()
 {
     $("#dtBox").DateTimePicker(
         {
             dateTimeFormat: 'd-m-Y'
         }
     );
 });
</script>
@endsection

@endsection