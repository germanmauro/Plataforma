@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                CURSOS DE LA PUBLICACIÓN: {{$publicacion->titulo}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>
                            Listado de cursos
                        </h4>
                        @foreach ($publicacion->cursosEliminar() as $item)
                            <p>
                                @if(count($item->users) == 0)
                                    <a class="error" onclick="eliminarCurso({{$item->id}})" title='EliminarCurso' data-toggle='tooltip'><span class='fas fa-times'></span></a>
                                @endif
                                Inicio: {{$item->inicio->format("d/m/Y H:i")}} - 
                                Cantidad de clases: {{count($item->days)}} - Cantidad de Alumnos : {{count($item->users)}}
                            </p>
                        @endforeach                   
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="error"> --}}
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        {{-- </div> --}}
                        <form name="envio" id="envio" role="form" action="{{route('publication.updatecalendar',$publicacion)}}" method="post">
                        @csrf
                        @method("put")
                        <div class="form-group">
                                <label>Ingrese fecha y hora del nuevo</label>
                                <table>
                                    <tr>
                                        <td>
                                            @php
                                                $fecha = new DateTime();
                                                if ($publicacion->tipo == "Grupal") {
                                                    $fecha->add(new DateInterval("P15D"));
                                                }  else {
                                                    $fecha->add(new DateInterval("P1D"));
                                                }
                                            @endphp

                                            <input type="date" min="{{$fecha->format('Y-m-d')}}"  class="form-control" required name="fecha" value="{{old('fecha',$fecha->format('Y-m-d'))}}">
                                        </td>
                                        <td>
                                            {{old("hora")}}
                                            <select class="form-control" name="hora">
                                                @for ($i = 0; $i < 24; $i++)
                                                    <option value="{{$i}}:00" {{ (old("hora") == $i) ? 'selected' : '' }}>{{$i}}:00 Hs</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            
                            
                        </div>
                        
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Cargar Nuevo</button>
                            <a href="/Publicaciones"  class="btn btn-danger">Regresar</a>
                        </form>
                    
                </div>
                    <!-- /.col-md-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-md-6 -->
</div>
@endsection
<script>
    //Borra imagenes
    function eliminarCurso(id) {
    swal("¿Desea eliminar el curso?", {
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
                                
                                url: '/Publicaciones/DeleteCourse/'+id,
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