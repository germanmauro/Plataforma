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
                    <div class="col-lg-6">
                        <form name="envio" id="envio" role="form" action="{{route("publication.update",$publicacion)}}" method="POST" enctype="multipart/form-data">
                            @method("put")
                            @csrf
                            
                            <div class="form-group">
                                <label>Título</label>
                                <input class="form-control" required name="titulo" maxlength="30" placeholder="Título" value= "{{$publicacion->titulo}}">
                            </div>
                            <div class="form-group">
                                <label>Elija una de sus especialidades</label>
                                <select class="form-control" required name="especialidad">
                                    @foreach ($user->specialties as $item)
                                        <option @if ($publicacion->specialty_id == $item->id)
                                            selected
                                        @endif
                                         value="{{$item->id}}">{{$item->nombre}} ({{$item->category->destinatario}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea rows="6" class="form-control" name="descripcion" required maxlength="1000" placeholder="Descripción (hasta 1000 caracteres)">{{$publicacion->descripcion}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Temas del curso</label>
                                <textarea rows="6" class="form-control" minlength="50" name="temas" required maxlength="5000" 
                                placeholder="Liste los temas del curso (hasta 5000 caracteres)">{{$publicacion->temas}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Beneficios del curso</label>
                                <textarea rows="6" class="form-control" minlength="50" name="beneficios" required maxlength="5000" 
                                placeholder="¿Que beneficios obtendrá el alumno? (hasta 5000 caracteres)">{{$publicacion->beneficios}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Aprendizaje del curso</label>
                                <textarea rows="6" class="form-control" minlength="50" name="aprendizaje" required maxlength="5000" 
                                placeholder="¿Qué aprenderá el alumno con este curso? (hasta 5000 caracteres)">{{$publicacion->aprendizaje}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nivel</label>
                                <select class="form-control" required name="nivel">
                                    <option @if($publicacion->nivel == "Principiante") selected @endif value="Principiante">Principiante</option>
                                    <option @if($publicacion->nivel == "Intermedio") selected @endif value="Intermedio">Intermedio</option>
                                    <option @if($publicacion->nivel == "Avanzado") selected @endif value="Avanzado">Avanzado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tipo de clase</label>
                                <select class="form-control" required name="tipo">
                                    <option @if($publicacion->tipo == "Grupal") selected @endif value="Grupal">Grupal (Varios Alumnos)</option>
                                    <option @if($publicacion->tipo == "Individual") selected @endif value="Individual">Individual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Cantidad de clases</label>
                                <select onchange="mostrarDuracion()" class="form-control" required name="clases" id="clases">
                                    <option value="0">Indefinido (Abono mensual)</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option @if($publicacion->clases == $i) selected @endif value="{{$i}}">{{$i}} Clases</option>
                                    @endfor
                                </select>
                            </div>
                            <div id="duracion" class="form-group">
                                <label>Duración del curso (en meses)</label>
                                <select class="form-control" name="duracion">
                                    @for ($i = 2; $i <= 12; $i++)
                                        <option @if($publicacion->duracion == $i) selected @endif value="{{$i}}">{{$i}} Meses</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Precio en Euros por clase</label>
                                <input type="number" step="any" class="form-control" required name="precio" maxlength="20" min=0.1 max=200 placeholder="Precio" value= "{{$publicacion->precio}}">
                            </div>
                            <div class="form-group">
                                <label>Imagen 1 (Si desea matener la misma no es necesario cargarla otra vez)</label>
                                <img height="60px" src="{{asset('storage/publicaciones/'.$publicacion->imagen1)}}">
                                <input type="file" name="imagen1" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Imagen 2 (Si desea matener la misma no es necesario cargarla otra vez)</label>
                                <img height="60px" src="{{asset('storage/publicaciones/'.$publicacion->imagen2)}}">
                                <input type="file" name="imagen2" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Imagen 3 (Si desea matener la misma no es necesario cargarla otra vez)</label>
                                <img height="60px" src="{{asset('storage/publicaciones/'.$publicacion->imagen3)}}">
                                <input type="file" name="imagen3" accept="image/*,pdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Video (Si posee un video, adjunte la url de youtube al siguiente aquí)</label>
                                <input class="form-control" name="video" maxlength="200" placeholder="Video (Url)" value= "{{$publicacion->video}}">
                            </div>
                            
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/Publicaciones"  class="btn btn-danger">Cancelar</a>
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
    mostrarDuracion();
</script>