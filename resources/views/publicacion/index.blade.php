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
                   targets: [1]
               }]}
            );
        });
</script>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix">
            <h2 class="pull-left">Mis Publicaciones</h2>
          </div>
          <div class="titulo">
            <p class="parrafo">
              Puede pausar, eliminar o reactivar (en caso de que ya esté pausada) una publicación.
            </p>
            <p class="parrafo">
              En caso de eliminar una publicación, la misma ya no estará disponible y no podrá ser reactivada.
            </p>
          </div>
          @if(count($publicaciones)>0)
              <table id='tabla' class='display menutable tablagrande'>
              <thead>
              <tr>
                <th>Título</th>
                <th>Descripcion</th>
                <th>Especialidad</th>
                <th>Duración</th>
                <th>Precio</th>
                <th>Imagen 1</th>
                <th>Imagen 2</th>
                <th>Imagen 3</th>
                <th>Video</th>
                <th>Estado</th>
                <th>Fecha Creación</th>
                <th>Fecha Actualización</th>
                <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($publicaciones as $item)
                    <tr>
                        <td>{{$item->titulo}} </td>
                        <td>{{$item->descripcion}} </td>
                        <td>{{$item->specialty->nombre}} </td>
                        <td>{{$item->duracion}} </td>
                        <td>{{$item->precio}} </td>
                        <td><img height="60px" src="{{asset('storage/publicaciones/'.$item->imagen1)}}" alt="imagen1"> </td>
                        <td><img height="60px" src="{{asset('storage/publicaciones/'.$item->imagen2)}}" alt="imagen2"> </td>
                        <td><img height="60px" src="{{asset('storage/publicaciones/'.$item->imagen3)}}" alt="imagen3"> </td>
                        <td>
                          @if ($item->video!="")
                          <a class="accionmenu" href="{{$item->video}}" target="_blank" rel="noopener noreferrer">Abrir video</a>    
                          @endif
                           
                        </td>
                        <td>{{$item->estado}} </td>
                        <td>{{$item->created_at->format('d/m/Y H:i:s')}} </td>
                        <td>{{$item->updated_at->format('d/m/Y H:i:s')}} </td>
                        <td>
                          @if ($item->estado=="Activa")
                              <a class="accionmenu" href="{{route('timerange.delete',$item->id) }}" title='Pausar Publicación' data-toggle='tooltip'><span class='fas fa-pause'></span></a>
                              <a class="accionmenu" href="{{route('timerange.delete',$item->id) }}" title='Eliminar Publicación' data-toggle='tooltip'><span class='fas fa-trash-alt'></span></a>

                          @endif
                          @if ($item->estado=="Pausada")
                              Reactivar
                          
                          @endif
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