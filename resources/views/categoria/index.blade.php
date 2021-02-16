@extends('layouts.main')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
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
            <h2 class="pull-left">Categorías</h2>
            <a href="/Categoria/Create" class="btn btn-success pull-right">Nueva Categoría</a>
          </div>

          @if(count($categorias)>0)
              <table id='tabla' class='display menutable'>
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($categorias as $item)
                    <tr>
                        <td>{{$item->nombre}} </td>
                        <td>
                          @if ($item->imagen!="")
                          <img height="60px" src="{{asset('storage/categorias/'.$item->imagen)}}" alt="imagen1">
                          @endif
                        </td>
                        <td>
                        <a class="accionmenu" href="{{route('category.edit',$item->id) }}" title='Actualizar Registro' data-toggle='tooltip'><i class='fas fa-edit'></i></span></a>
                        <a class="accionmenu" href="{{route('category.delete',$item->id) }}" title='Eliminar Registro' data-toggle='tooltip'><span class='fas fa-trash-alt'></span></a>
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