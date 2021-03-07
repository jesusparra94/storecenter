<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroUsuario extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre;
    public $rut;
    public $clave;
    public $modo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre,$rut,$clave,$modo)
    {
        //
        $this->nombre = $nombre;
        $this->rut = $rut;
        $this->clave = $clave;
        $this->modo = $modo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('web@storecenter.cl')
        ->view('cliente.correoregistro');
    }
}
