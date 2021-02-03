@extends('layouts.main')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
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
              <table id='tabla' class='display menutable'>
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>E-mail</th>
                <th>Fecha Nacimiento</th>
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
                        <a class="accionmenu" href="{{route('profesor.info',$item) }}" title='Más información' data-toggle='tooltip'><i class='fas fa-info-circle'></i></span></a>
                         @if ($item->estado=="a entrevistar"||$item->estado=="invalidado")
                             <a class="accionmenu" onclick="habilitarprofesor({{$item->id}})" title='Habilitar Profesor' data-toggle='tooltip'><i class='far fa-thumbs-up'></i></span></a>
                         @endif
                         @if ($item->estado=="validado")
                             <a class="accionmenu" onclick="deshabilitarprofesor({{$item->id}})" title='Dehabilitar Profesor' data-toggle='tooltip'><i class='far fa-thumbs-down'></i></span></a>
                         @endif
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
    <script>
      function habilitarprofesor(id) {
        swal("¿Desea habilitar al profesor?", {
            icon:"warning",
            buttons: {
                catch: {
                    text: "SI",
                    value: "catch",
                },
                cancel: "NO",
                },
            })
              .then((value) => {
                    var token = '{{csrf_token()}}';
                    switch (value) {
                        case "catch":
                            $.ajax
                                ({
                                    
                                    url: '/AdministrarProfesores/Habilitar/'+id,
                                    data: { _token:token },
                                    type: 'post',
                                    cache: false,
                                    success: function (r) {
                                            location.reload();
                                    }
                                });
                            break;
                    }
                });    
        }

      function deshabilitarprofesor(id) {
        swal("¿Desea deshabilitar al profesor?", {
            icon:"warning",
            buttons: {
                catch: {
                    text: "SI",
                    value: "catch",
                },
                cancel: "NO",
                },
            })
              .then((value) => {
                    var token = '{{csrf_token()}}';
                    switch (value) {
                        case "catch":
                            $.ajax
                                ({
                                    
                                    url: '/AdministrarProfesores/Deshabilitar/'+id,
                                    data: { _token:token },
                                    type: 'post',
                                    cache: false,
                                    success: function (r) {
                                        location.reload();
                                    }
                                });
                            break;
                    }
                });    
        }
    </script>
@endsection