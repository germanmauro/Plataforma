@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                ACTUALIZAR CATEGORÍA DE ESPECIALIDAD
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form name="envio" id="envio" role="form" action="{{route("category.update",$categoria)}}" method="POST" enctype="multipart/form-data">
                            @method("put")
                            @csrf
                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" required id="nombre" name="nombre" maxlength="30" placeholder="Nombre" value= "{{$categoria->nombre}}">
                            </div>
                            <div class="form-group">
                                <label>Destinatario</label>
                                <select class="form-control" required name="destinatario">
                                    <option @if($categoria->destinatario == "Adultos") selected @endif value="Adultos">Adultos</option>
                                    <option @if($categoria->destinatario == "Niños") selected @endif value="Niños">Niños</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Texto</label>
                                <textarea rows="6" class="form-control" name="texto" required maxlength="5000" placeholder="Descripción (hasta 5000 caracteres)">{{$categoria->texto}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Imagen (Si desea matener la misma no es necesario cargarla otra vez)</label>
                                <img height="60px" src="{{asset('storage/categorias/'.$categoria->imagen)}}">
                                <input type="file" name="imagen" accept="image/*,pdf" class="form-control">
                            </div>
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/Categoria"  class="btn btn-danger">Cancelar</a>
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