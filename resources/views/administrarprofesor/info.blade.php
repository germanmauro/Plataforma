@extends('layouts.main')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('css/estiloprincipal.css') }}"> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('js/bootstrap.min.js') }}"> </script> --}}
<link rel="stylesheet" href="{{asset('Tables/jquery.dataTables.css')}}">
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix">
            <h2 class="detalle"><span class="infoicono"><i class='fas fa-info-circle'></i></span> Información del profesor {{$user->nombre}} {{$user->apellido}}</h2>
          </div>
          <div class="infoprofesor">
            <div class="row">
              <div class="col-md-12">
                    @if($user->foto!="")
                        <img class="perfil-img" src="/storage/foto/{{$user->foto}}"/>
                    @endif
                </div>
                <div class="col-md-12">
                    <p class="detalle">
                            Estado
                            <span class="detalledesc">
                                {{ucfirst($user->estado)}}
                            </span>
                        </p>
                        {{-- <p class="detalle">
                            Contrato: 
                          @if ($user->contrato==null)
                           <span class="detalledesc">Sin enviar </span>
                          @else 
                            <span class="detalledesc">{{$user->contrato}} </span>
                        @endif 
                        </p> --}}
                </div>
                <div class="col-md-6">
                        <p class="detalle">DNI <span class="detalledesc">{{$user->dni}} </span></p> 
                        <p class="detalle">TELÉFONO <span class="detalledesc">{{$user->telefono}} </span></p>
                        <p class="detalle">DATOS BANCARIOS
                          <br> <span class="detalledesc">Banco: {{$user->banco}}</span>
                          <br> <span class="detalledesc">CBU: {{$user->cbu}}</span>
                          <br> <span class="detalledesc">Cuenta: {{$user->cuentabancaria}}</span>
                          <br> <span class="detalledesc">Alias: {{$user->alias}}</span>
                          <br> <span class="detalledesc">Titular: {{$user->titular}}</span>
                        </p>
                        <p class="detalle">E-MAIL <span class="detalledesc">{{$user->email}}</span> </p>
                        <p class="detalle">PAYPAL
                          <br> <span class="detalledesc">E-mail: {{$user->paypal}}</span>
                        </p>
                        <p class="detalle">E-MAIL <span class="detalledesc">{{$user->email}}</span> </p>
                        <p class="detalle">FECHA DE NACIMIENTO <span class="detalledesc">{{$user->fechanacimiento->format('d/m/Y')}}</span> </p>
                        <p class="detalle">EDAD <span class="detalledesc">{{$user->fechanacimiento->diff(new DateTime())->format("%y")}} años</span> </p>
                </div>
                <div class="col-md-6">
                        <p class="detalle">Especialidades
                            <span class="detalledesc">
                            @foreach ($user->specialties as $esp)
                                <br>
                                    {{$esp->nombre}}
                            @endforeach 
                            </span>
                        </p>
                
                        <p class="detalle">Título 
                            <span class="detalledesc">
                            @if($user->titulo=="")
                                No enviado
                            @else
                                <a class="accionmenu" target="_blank" href="{{$user->path($user->titulo)}}">Abrir</a>
                            @endif
                            </span>
                        </p>
                        <p class="detalle">Contrato 
                            <span class="detalledesc">
                            @if($user->contrato=="")
                                No enviado
                            @else
                                <a class="accionmenu" target="_blank" href="{{$user->path($user->contrato)}}">Abrir</a>
                            @endif
                            </span>
                        </p>
                
                        <p class="detalle"> 
                            Días elegidos <span class="detalledesc">
                            @foreach ($user->availabilities as $ava)
                                 <br>   {{$ava->dia}} Desde: {{$ava->desde()}} hs Hasta: {{$ava->hasta()}} hs
                            @endforeach 
                            </span>
                        </p>                       
                        
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection