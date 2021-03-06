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
                                <input class="form-control" required name="titulo" maxlength="30" placeholder="Título" value= "{{old('titulo')}}">
                            </div>
                            <div class="form-group">
                                <label>Elija una de sus especialidades</label>
                                <select class="form-control" required name="especialidad">
                                    @foreach ($user->specialties as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}} ({{$item->category->nombre}} {{$item->category->destinatario}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea rows="6" class="form-control" name="descripcion" required maxlength="1000" placeholder="Descripción (hasta 1000 caracteres)">{{old('descripcion')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Temas del curso</label>
                                <textarea rows="6" class="form-control" minlength="50" name="temas" required maxlength="5000" 
                                placeholder="Liste los temas del curso (hasta 5000 caracteres)">{{old('temas')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Beneficios del curso</label>
                                <textarea rows="6" class="form-control" minlength="50" name="beneficios" required maxlength="5000" 
                                placeholder="¿Que beneficios obtendrá el alumno? (hasta 5000 caracteres)">{{old('beneficios')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Aprendizaje del curso</label>
                                <textarea rows="6" class="form-control" minlength="50" name="aprendizaje" required maxlength="5000" 
                                placeholder="¿Qué aprenderá el alumno con este curso? (hasta 5000 caracteres)">{{old('aprendizaje')}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nivel</label>
                                <select class="form-control" required name="nivel">
                                    <option value="Principiante">Principiante</option>
                                    <option value="Intermedio">Intermedio</option>
                                    <option value="Avanzado">Avanzado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tipo de clase</label>
                                <select onchange="mostrarAlumnos()" class="form-control" required id="tipo" name="tipo">
                                    <option value="Grupal">Grupal (Varios Alumnos)</option>
                                    <option value="Individual">Individual</option>
                                </select>
                            </div>
                            <div id="alumnos" class="form-group">
                                <label>Cantidad mínima de alumnos</label>
                                <select class="form-control" name="alumnos">
                                    @for ($i = 1; $i <= 20; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
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
                                <label>Imágen 1 (Opcional - Proporción correcta: 50% más ancha que alta)  </label>
                                <input type="file" name="imagen1" accept="image/*" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Imágen 2 (Opcional - Proporción correcta: 50% más ancha que alta) </label>
                                <input type="file" name="imagen2" accept="image/*" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Imágen 3 (Opcional - Proporción correcta: 50% más ancha que alta) </label>
                                <input type="file" name="imagen3" accept="image/*" class="form-control">
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
    function mostrarAlumnos()
    {
        var tipo = document.getElementById("tipo").value;
        if(tipo == "Grupal") {
            $("#alumnos").show();
        } else {
            $("#alumnos").hide();
        }
    }
</script>