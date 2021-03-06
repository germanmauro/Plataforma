@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                CARGUE EL CONTRATO QUE SE ENVIARÁ A LOS PROFESORES
            </div>
            <div class="panel-body">
                <div class="row">
                    
                        <form name="envio" id="envio" role="form" action="{{route("contract.update")}}" method="POST" enctype="multipart/form-data">
                            @method("put")
                            @csrf
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{-- <label>Monto</label> --}}
                                <div class="form-group">
                                <input required type="file" name="contrato" accept="application/pdf" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Cargar contrato a enviar</button>
                        </div>
                          </form>
                    

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