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
                   targets: [2]
               }]}
            );
        });
</script>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix">
            <h2 class="pull-left">Rangos Horarios</h2>
            <a href="/RangoHorario/Create" class="btn btn-success pull-right">Nuevo Rango Horario</a>
          </div>

          @if(count($rangos)>0)
              <table id='tabla' class='display menutable'>
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Rango</th>
                <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($rangos as $item)
                    <tr>
                        <td>{{$item->nombre}} </td>
                        <td>{{$item->rango}} </td>
                        <td>
                        <a class="accionmenu" href="{{route('timerange.edit',$item->id) }}" title='Actualizar Registro' data-toggle='tooltip'><i class='fas fa-edit'></i></span></a>
                        <a class="accionmenu" href="{{route('timerange.delete',$item->id) }}" title='Eliminar Registro' data-toggle='tooltip'><span class='fas fa-trash-alt'></span></a>
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