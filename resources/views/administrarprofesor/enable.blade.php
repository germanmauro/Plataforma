@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                ELIMINAR CATEGORÍA DE ESPECIALIDAD
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route("profesor.enable",$user)}}" method="post">
                            @csrf
                            @method("put")
                        <div class="alert alert-danger fade in">
                            <p>¿Desea habilitar al profesor {{$user->nombre}} {{$user->apellido}}?</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="/AdministrarProfesores" class="btn btn-default">No</a>
                            </p>
                        </div>
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