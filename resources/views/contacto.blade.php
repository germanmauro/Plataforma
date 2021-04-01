@extends('layouts.info')
@section('content')

<div class="contact-info">
    <h1 class="titulo">
        CONTÁCTENOS
    </h1>
    <div class="row text-center">
        <div class="col-md-8 col-md-offset-2">
            <h4>
                <strong><i class="fas fa-phone"></i> WhatsApp</strong> +39 351 9181771
            </h4>
            <h4>
                <strong><i class="fas fa-envelope"></i> E-mail</strong> <a href="mailto:info@capacitacionee.com">info@capacitacionee.com</a>
            </h4>
            <h4>
                <strong><i class="fab fa-facebook-f"></i> Facebook</strong> <a target="_blank" href="https://www.facebook.com/capacitacionee">@capacitacionee</a>
            </h4>
            
        </div>
    </div>
    
    <div class="row">
    
        <div class="col-md-12">
                <h3>Contacto Directo</h3>

                <form name="contacto" id="contacto" method="POST" action="{{route('contacto')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text"  name="nombre" maxlength="50" id="nombre" class="form-control" required="required" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" name="apellido" maxlength="100" id="apellido" class="form-control" required="required"
                                    placeholder="Apellido">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text"  name="telefono" maxlength="50" id="telefono" class="form-control" required="required" placeholder="Teléfono">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" name="email" id="email" maxlength="100" class="form-control" required="required" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea name="mensaje" id="mensaje" maxlength="300" required="required" class="form-control" rows="3" placeholder="Mensaje"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="Send" name="Send" class="btn btn-default">Enviar Mensaje</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    
    </div>
</div>

@endsection