@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                GENERE UNA NUEVA PUBLICACIÓN DE CLASE
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="envio" id="envio" role="form" action="/Publicaciones/Store" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label>Título</label>
                                <input class="form-control" required name="titulo" maxlength="100" placeholder="Título" value= "{{old('titulo')}}">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea rows="6" class="form-control" name="descripcion" required maxlength="1000" placeholder="Descripción (hasta 1000 caracteres)">{{old('descripcion')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Elija una de sus especialidades</label>
                                <select class="form-control" required name="especialidad">
                                    @foreach ($user->specialties as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Duración del curso (Opcional)</label>
                                <input class="form-control" required name="duracion" maxlength="100" placeholder="Duración" value= "{{old('duracion')}}">
                            </div>
                            <div class="form-group">
                                <label>Precio por mes (4 clases)</label>
                                <input type="number" step="any" class="form-control" required name="precio" maxlength="20" placeholder="Precio" value= "{{old('precio')}}">
                            </div>
                            <div class="form-group">
                                <label>Imágen 1 (Opcional)</label>
                                <input type="file" name="imagen1" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Imágen 2 (Opcional)</label>
                                <input type="file" name="imagen2" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Imágen 3 (Opcional)</label>
                                <input type="file" name="imagen3" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Video (Adjunte la url de youtube al siguiente aquí)</label>
                                <input class="form-control" required name="video" maxlength="200" placeholder="Video (Url)" value= "{{old('video')}}">
                            </div>
                            

                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/"  class="btn btn-warning">Cencelar</a>
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