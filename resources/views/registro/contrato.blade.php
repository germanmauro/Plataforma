@extends('layouts.main')
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading informacion-header">
                CONTRATO DE EXCLUSIVIDAD
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 informacion">
                        <h4>Revise su casilla de e-mail</h4>
                        <p>Hemos enviado un contrato de exclusividad con la plataforma.</p>
                        <p>El mismo debe ser descargado, firmado y subido a la plataforma
                            para su posterior aprobación.
                        </p>
                        <p>Una vez aprobada la documentación, su perfil estará activo para
                            que pueda operar dentro de la plataforma.
                        </p>
                        <p>Gracias por elegirnos,
                            <br>
                            El equipo de Capacitación en Español
                        </p>
                        @if(session()->has('Perfil')&&session('Perfil')!="admin")
                            @switch(session('Estado'))
                                @case("registrado")
                                    <div class="alert alert-danger" role="alert">
                                        Debe validar su e-mail. Le hemos enviado un correo a su casiila. 
                                        Si no lo encuentra revise el spam.
                                    </div>
                                    @break
                                @case("contrato a enviar")
                                <div class="alert alert-danger" role="alert">
                                        Debe subir el contrato recibido por e-mail firmado. <a href="/Contrato/Carga" class="btn btn-default"> Cargueló aquí </a>
                                </div>
                                    @break
                                @case("contrato a validar")
                                <div class="alert alert-success" role="alert">
                                        Su contrato de ha cargado de forma exitosa. Cuando el administrador lo apruebe recibirá un e-mail y podrá
                                        comenzar a operar en la plataforma.
                                </div>
                                    @break
                            @endswitch
                        @endif
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