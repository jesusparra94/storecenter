<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotizacionUnica extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre;
    public $producto;
    public $codigo;
    public $ciudad;
    public $empresa;
    public $email;
    public $telefono;
    public $modo;
    public $num;
    public $comentarios;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre,$producto,$codigo,$ciudad,$empresa,$email,$telefono,$modo,$num,$comentarios)
    {
        $this->nombre = $nombre;
        $this->producto = $producto;
        $this->codigo = $codigo;
        $this->ciudad = $ciudad;
        $this->empresa = $empresa;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->modo = $modo;
        $this->num = $num;
        $this->comentarios = $comentarios;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('web@storecenter.cl')
        ->view('cotizaciones.correo');
    }
}
