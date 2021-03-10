<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class notificationMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $subject = "Notificación de CEE";
    public $titulo = "Notificación de CEE";
    public $mensaje = "Notificación de CEE";

    public function __construct($subject,$titulo, $mensaje)
    {
        $this->subject = $subject;
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.notificacion');
    }
}
