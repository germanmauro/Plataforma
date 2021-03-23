@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                REGISTRE UNA NUEVA ESPECIALIDAD
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form name="envio" id="envio" role="form" action="/Especialidad/Store" method="post">
                            @csrf
                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" required id="nombre" name="nombre" maxlength="100" placeholder="Nombre" value= "{{old('nombre')}}">
                            </div>

                            <div class="form-group">
                                <label>Categoría</label>
                                <select class="form-control" required name="categoria">
                                    @foreach ($categorias as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}} ({{$item->destinatario}})</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/Especialidad"  class="btn btn-danger">Cancelar</a>
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