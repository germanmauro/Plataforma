@extends('layouts.main')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('css/estiloprincipal.css') }}"> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#tabla').DataTable({
                columnDefs: [{
                   orderable: false,
                   targets: [16]
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
            <p class="parrafo">
              Para poder modificar una publicación, la misma no debe tener cursos creados.
            </p>
          </div>
          @if(count($publicaciones)>0)
              <table id='tabla' class='display menutable tablagrande'>
              <thead>
              <tr>
                <th>Título</th>
                <th>Descripcion</th>
                <th>Especialidad</th>
                <th>Nivel</th>
                <th>Tipo</th>
                <th>Duración</th>
                <th>Cursos Activos</th>
                <th>Precio / Clase</th>
                <th>Total</th>
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
                        <td>
                          @if (strlen($item->descripcion)>100)
                            {{substr($item->descripcion,0,100)}}..
                          @else
                            {{$item->descripcion}}    
                          @endif 
                       </td>
                        <td>{{$item->specialty->nombre}}</td>
                        <td>{{$item->nivel}} </td>
                        <td>{{$item->tipo}} </td>
                        <td>
                          @if($item->clases==0)
                            {{$item->duracion}} Meses
                            @else
                            {{$item->clases}} Clases
                          @endif
                        </td>
                        <td>
                          {{count($item->cursosActivos())}}
                        </td>
                        <td>{{$item->precio}}</td>
                        <td>{{$item->total}}</td>
                        <td>
                          @if ($item->imagen1!="")
                              <a class="error" onclick="borrarimagen({{$item->id}},1)" title='Eliminar' data-toggle='tooltip'><span class='fas fa-times'></span></a>
                          <img width="80px" src="{{asset('storage/publicaciones/'.$item->imagen1)}}" alt="imagen1">
                          @endif
                        </td>
                        <td>
                          @if ($item->imagen2!="")
                              <a class="error" onclick="borrarimagen({{$item->id}},2)" title='Eliminar' data-toggle='tooltip'><span class='fas fa-times'></span></a>
                          <img width="80px" src="{{asset('storage/publicaciones/'.$item->imagen2)}}" alt="imagen1">
                          @endif
                        </td>
                        <td>
                          @if ($item->imagen3!="")
                              <a class="error" onclick="borrarimagen({{$item->id}},3)" title='Eliminar' data-toggle='tooltip'><span class='fas fa-times'></span></a>
                          <img width="80px" src="{{asset('storage/publicaciones/'.$item->imagen3)}}" alt="imagen1">
                          @endif
                        </td>
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
                              {{-- @if($item->tipo == "Grupal") --}}
                                <a class="accionmenu" href="{{route('publication.calendar',$item->id) }}" title='Administrar Cursos' data-toggle='tooltip'><i class='fas fa-calendar'></i></span></a>
                              {{-- @endif --}}
                              @if(count($item->courses) == 0)
                                <a class="accionmenu" onclick="pausar({{$item->id}})" title='Pausar Publicación' data-toggle='tooltip'><span class='fas fa-pause'></span></a>
                                <a class="accionmenu" onclick="eliminar({{$item->id}})" title='Eliminar Publicación' data-toggle='tooltip'><span class='fas fa-trash-alt'></span></a>
                                <a class="accionmenu" href="{{route('publication.edit',$item->id) }}" title='Actualizar Registro' data-toggle='tooltip'><i class='fas fa-edit'></i></span></a>
                              @endif
                          @endif
                          @if ($item->estado=="Pausada")
                              <a class="accionmenu" onclick="reactivar({{$item->id}})" title='Reactivar Publicación' data-toggle='tooltip'><span class='fas fa-check-circle'></span></a>
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
<script>
  function pausar(id) {
    swal("¿Desea pausar la publicación?", {
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
                                
                                url: '/Publicaciones/Pausar/'+id,
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

  function eliminar(id) {
    swal("¿Desea eliminar la publicación?", {
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
                                
                                url: '/Publicaciones/Delete/'+id,
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

  function reactivar(id) {
    swal("¿Desea ractivar la publicación?", {
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
                                
                                url: '/Publicaciones/Reactivar/'+id,
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
    //Borra imagenes
    function borrarimagen(id,imagen) {
    swal("¿Desea eliminar la imagen?", {
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
                                
                                url: '/Publicaciones/DeleteImage/'+id+'/'+imagen,
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