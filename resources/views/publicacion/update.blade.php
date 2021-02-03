@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                ACTUALIZAR DATOS DE PUBLICACIÓN
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="envio" id="envio" role="form" action="{{route("publication.update",$publicacion)}}" method="POST" enctype="multipart/form-data">
                            @method("put")
                            @csrf
                            
                            <div class="form-group">
                                <label>Título</label>
                                <input class="form-control" required name="titulo" maxlength="100" placeholder="Título" value= "{{$publicacion->titulo}}">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea rows="6" class="form-control" name="descripcion" required maxlength="1000" placeholder="Descripción (hasta 1000 caracteres)">{{$publicacion->descripcion}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Elija una de sus especialidades</label>
                                <select class="form-control" required name="especialidad">
                                    @foreach ($user->specialties as $item)
                                        <option @if ($publicacion->specialty_id == $item->id)
                                            selected
                                        @endif
                                         value="{{$item->id}}">{{$item->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Duración del curso (Opcional)</label>
                                <input class="form-control" required name="duracion" maxlength="100" placeholder="Duración" value= "{{$publicacion->duracion}}">
                            </div>
                            <div class="form-group">
                                <label>Precio en Euros por mes (4 clases)</label>
                                <input type="number" step="any" class="form-control" required name="precio" maxlength="20" placeholder="Precio" value= "{{$publicacion->precio}}">
                            </div>
                            <div class="form-group">
                                <label>Imágen 1 (Si desea matener la misma no es necesario cargarla otra vez)</label>
                                <img height="60px" src="{{asset('storage/publicaciones/'.$publicacion->imagen1)}}">
                                <input type="file" name="imagen1" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Imágen 2 (Si desea matener la misma no es necesario cargarla otra vez)</label>
                                <img height="60px" src="{{asset('storage/publicaciones/'.$publicacion->imagen2)}}">
                                <input type="file" name="imagen2" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Imágen 3 (Si desea matener la misma no es necesario cargarla otra vez)</label>
                                <img height="60px" src="{{asset('storage/publicaciones/'.$publicacion->imagen3)}}">
                                <input type="file" name="imagen3" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Video (Si posee un video, adjunte la url de youtube al siguiente aquí)</label>
                                <input class="form-control" required name="video" maxlength="200" placeholder="Video (Url)" value= "{{$publicacion->video}}">
                            </div>
                            
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/Publicaciones"  class="btn btn-warning">Cencelar</a>
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
@endsection