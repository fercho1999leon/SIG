<?php

namespace App\Mail;

use App\Student2;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnvioDocumentos extends Mailable
{
    use Queueable, SerializesModels;

    public $estudianteXaño;
    public $representante;

    public function __construct($newStudent, $representante)
    {
        $this->estudianteXaño = $newStudent;
        $this->representante = $representante;
    }

    public function build()
    {
        return $this->view('mail.archivos')->subject('Inscripcion')->attach(public_path('/storage/admisiones/admisiones.pdf'));
    }
}
