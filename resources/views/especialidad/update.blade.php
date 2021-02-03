@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                ACTUALIZAR DATOS DE ESPECIALIDAD
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form name="envio" id="envio" role="form" action="{{route("specialty.update",$especialidad)}}" method="POST">
                            @method("put")
                            @csrf
                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" required id="nombre" name="nombre" maxlength="100" placeholder="Nombre" value= "{{$especialidad->nombre}}">
                            </div>
                            <div class="form-group">
                                <label>Categoría</label>
                                <select class="form-control" required name="categoria">
                                    @foreach ($categorias as $item)
                                        <option @if ($especialidad->category->id == $item->id)
                                            selected
                                        @endif
                                         value="{{$item->id}}">{{$item->nombre}}
                                        </option>
                                    @endforeach
                                </select>
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