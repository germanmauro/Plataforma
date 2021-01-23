@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                MONTO POR HORA EN EUROS
            </div>
            <div class="panel-body">
                <div class="row">
                    
                        <form name="envio" id="envio" role="form" action="{{route("amount.update",$monto)}}" method="POST">
                            @method("put")
                            @csrf
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{-- <label>Monto</label> --}}
                                <input type="number" step="any" class="form-control" required id="valor" name="valor" min=0 max=10000 placeholder="Monto por hora" value= "{{$monto->valor}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" id="Send" name="Send" class="btn btn-default">Actualizar Monto</button>
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