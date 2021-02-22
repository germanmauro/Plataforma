@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                REGISTRE UNA NUEVA CATEGORÍA DE ESPECIALIDAD
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form name="envio" id="envio" role="form" action="/Categoria/Store" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" required id="nombre" name="nombre" maxlength="20" placeholder="Nombre" value= "{{old('nombre')}}">
                            </div>
                            <div class="form-group">
                                <label>Texto</label>
                                <textarea rows="6" class="form-control" name="texto" required maxlength="5000" placeholder="Texto (hasta 5000 caracteres)">{{old('texto')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Imágen (Opcional)</label>
                                <input type="file" name="imagen" accept="image/*,pdf" class="form-control">
                            </div>
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/Categoria"  class="btn btn-danger">Cencelar</a>
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