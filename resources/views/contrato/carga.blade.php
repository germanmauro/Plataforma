@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                SUBA EL ARCHIVO CON EL CONTRATO FIRMADO
            </div>
            <div class="panel-body">
                <div class="row">
                    
                        <form name="envio" id="envio" role="form" action="/Contrato/Store" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input required type="file" name="contrato" id="contrato" accept="application/pdf" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Cargar contrato</button>
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