@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                REGISTRATE COMO PROFESOR PARA PODER ENSEÑAR TUS CONOCIMIENTOS.
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form name="envio" id="envio" role="form" action="" method="post">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" required id="nombre" name="nombre" maxlength="20" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label>Apellido</label>
                                <input type="text" required class="form-control" id="apellido" name="apellido" maxlength="20" placeholder="Apellido">
                            </div>
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" required class="form-control" id="direccion" name="direccion" maxlength="200" placeholder="Dirección">
                            </div>
                            <div class="form-group">
                                <label>DNI (Necesario para ingresar al sistema)</label>
                                <input type="text" required class="form-control" id="dni" name="dni" minlength="6" maxlength="15" placeholder="DNI Necesario para ingresar al sistema">
                            </div>
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" required class="form-control" id="telefono" name="telefono" maxlength="20" placeholder="Telefono">
                            </div>
                            <div class="form-group">
                                <label>E-Mail (Opcional)</label>
                                <input type="email" class="form-control" name="email" id="email" maxlength="60" placeholder="E-Mail">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input required class="form-control" id="pass" name="pass" minlength="8" maxlength="30" placeholder="Contraseña">
                            </div>
                            <div class="form-group">
                                <label>Repetir contraseña</label>
                                <input required class="form-control" id="passrepeat" name="passrepeat" minlength="8" maxlength="20" placeholder="Repetir Contraseña">
                            </div>

                            <button type="submit" id="Send" name="Send" class="btn btn-default">Confirmar Registro</button>
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