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
                        <form name="envio" id="envio" role="form" action="{{route("category.update",$categoria)}}" method="POST">
                            @method("put")
                            @csrf
                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" required id="nombre" name="nombre" maxlength="20" placeholder="Nombre" value= "{{$categoria->nombre}}">
                            </div>

                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/Categoria"  class="btn btn-warning">Cencelar</a>
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