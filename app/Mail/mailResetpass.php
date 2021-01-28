<?php

namespace App\Mail;

use App\Models\User;
use Crabbly\Fpdf\Fpdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class mailResetpass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject="Password reseteado con éxito";
    public $user;
    public $newpass;

    public function __construct(User $user,$newpass)
    {
        $this->user = $user;
        $this->newpass = $newpass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->view('email.resetpass');
    }
}
