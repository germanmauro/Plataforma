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
            <h2 class="pull-left">Administrar Alumnos</h2>
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
                <th>Fecha de nacimiento</th>
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
                        <td>{{$item->fechanacimiento->format('d/m/Y')}} </td>
                        <td>
                          {{ucfirst($item->estado)}}
                        </td>
                      
                        <td>
                        <a class="accionmenu" href="{{route('category.edit',$item->id) }}" title='Actualizar Registro' data-toggle='tooltip'><i class='fas fa-edit'></i></span></a>
                        <a class="accionmenu" href="{{route('category.delete',$item->id) }}" title='Eliminar Registro' data-toggle='tooltip'><span class='fas fa-trash-alt'></span></a>
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