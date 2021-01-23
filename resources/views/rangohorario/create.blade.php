@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                REGISTRE UN NUEVO RANGO
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form name="envio" id="envio" role="form" action="/RangoHorario/Store" method="post">
                            @csrf
                            
                            <div class="form-group">
                                <label>Nombre (Ej: Turno noche)</label>
                                <input class="form-control" required id="nombre" name="nombre" maxlength="30" placeholder="Nombre" value= "{{old('nombre')}}">
                            </div>
                            <div class="form-group">
                                <label>Rango (Ej: 18 a 22)</label>
                                <input class="form-control" required id="rango" name="rango" maxlength="30" placeholder="Rango" value= "{{old('rango')}}">
                            </div>

                            <button type="submit" id="Send" name="Send" class="btn btn-default">Guardar</button>
                            <a href="/RangoHorario"  class="btn btn-warning">Cencelar</a>
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