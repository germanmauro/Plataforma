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
                    <div class="col-lg-6">
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
                                        <option value="{{$item->id}}">{{$item->nombre}} ({{$item->category->destinatario}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tipo de clase (Si elije Grupal, luego deberá cargar las los inicios de cada curso)</label>
                                <select class="form-control" required name="tipo">
                                    <option value="Grupal">Grupal (Varios Alumnos)</option>
                                    <option value="Individual">Individual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Cantidad de clases</label>
                                <select onchange="mostrarDuracion()" class="form-control" required name="clases" id="clases">
                                    <option value="0">Indefinido (Abono mensual)</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{$i}}">{{$i}} Clases</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="duracion" class="form-group">
                                <label>Duración del curso (en meses)</label>
                                <select class="form-control" name="duracion">
                                    @for ($i = 2; $i <= 12; $i++)
                                        <option value="{{$i}}">{{$i}} Meses</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Precio en Euros por clase</label>
                                <input type="number" step="any" class="form-control" required name="precio" maxlength="20" min=0.1 max=200 placeholder="Precio" value= "{{old('precio')}}">
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
                                <label>Video (Si posee un video, adjunte la url de youtube al siguiente aquí)</label>
                                <input class="form-control"  name="video" maxlength="200" placeholder="Video (Url)" value= "{{old('video')}}">
                            </div>

                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/"  class="btn btn-danger">Cancelar</a>
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
    <!-- /.col-lg-6 -->
</div>
@endsection
<script>
    function mostrarDuracion()
    {
        var clase = document.getElementById("clases").value;
        if(clase == 0) {
            $("#duracion").show();
        } else {
            $("#duracion").hide();
        }
    }
</script>