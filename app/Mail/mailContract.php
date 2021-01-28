<?php

namespace App\Mail;

use Crabbly\Fpdf\Fpdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class mailContract extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $subject = "Envío de contrato de exclusividad";
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = new Fpdf();
        $pdf->SetMargins(5, 5, 5, 5);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->MultiCell(200, 10, "Buenas tardes " . $this->user->nombre . " como andas, este es un texto largo para probar \n como funciona todas esta mierda del ojete, hay que probar si entra todo lo que escribo y si lo divide bien");
        return $this->view('email.contrato')->attachData($pdf->Output("S"),"contato.pdf");
    }
}
