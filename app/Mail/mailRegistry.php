<?php

namespace App\Mail;

use App\Models\User;
use Crabbly\Fpdf\Fpdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class mailRegistry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject="Registro exitoso";
    public $user;
    public $cadenaverificacion;

    public function __construct(User $user,$cadenadaverificacion)
    {
        $this->user = $user;
        $this->cadenaverificacion = $cadenadaverificacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        if($this->user->perfil=="profesor") {
            return $this->view('email.registroprofesor');
        } else {
            return $this->view('email.registroalumno');
        }
        
    }
}
