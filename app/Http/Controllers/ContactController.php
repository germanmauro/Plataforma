<?php

namespace App\Http\Controllers;

use App\Mail\mailContact;
use App\Mail\notificationMessage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contacto (Request $request)
    {
        $contacto = new Contact();
        $contacto->nombre = $request->nombre;
        $contacto->apellido = $request->apellido;
        $contacto->email = $request->email;
        $contacto->mensaje = $request->mensaje;
        $contacto->telefono = $request->telefono;
        Mail::to("info@capacitacionee.com")->send(new notificationMessage("hola","como anda","mensaje"));
        return redirect('')->with('success','Mensaje enviado con éxito, en breve le responderemos');
    }
}
