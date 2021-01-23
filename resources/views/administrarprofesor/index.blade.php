@extends('layouts.main')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('css/estiloprincipal.css') }}"> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('js/bootstrap.min.js') }}"> </script> --}}
<link rel="stylesheet" href="{{asset('Tables/jquery.dataTables.css')}}">
<script src="{{asset('Tables/jquery.dataTables.js')}}"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#tabla').DataTable({
                columnDefs: [{
                   orderable: false,
                   targets: [8]
               }]}
            );
        });
</script>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix">
            <h2 class="pull-left">Administrar Profesores</h2>
          </div>

          @if(count($usuarios)>0)
              <table id='tabla' class='display menutable tablagrande'>
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>E-mail</th>
                <th>Contrato</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($usuarios as $item)
                    <tr>
                        <td>{{$item->nombre}} </td>
                        <td>{{$item->apellido}} </td>
                        <td>{{$item->usuario}} </td>
                        <td>{{$item->dni}} </td>
                        <td>{{$item->telefono}} </td>
                        <td>{{$item->email}} </td>
                        
                        <td>
                          @if ($item->contrato==null)
                           Sin enviar
                          @else 
                            {{$item->contrato}}
                        @endif </td>
                        <td>
                        @switch($item->estado)
                            @case("registrado")
                                E-mail a validar
                                @break
                            @case("validado")
                                Contrato sin enviar
                                @break
                            @case("aceptado")
                                Aceptado
                                @break
                            
                            @default
                                
                        @endswitch
                        </td>
                      
                        <td>
                        <a class="accionmenu" href="{{route('profesor.info',$item) }}" title='Más información' data-toggle='tooltip'><i class='fas fa-info-circle'></i></span></a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @else
            <p class='lead'><em>No hay registros.</em></p>
        @endif
        </div>
      </div>
    </div>
@endsection