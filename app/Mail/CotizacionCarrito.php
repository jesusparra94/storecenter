<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotizacionCarrito extends Mailable
{
    use Queueable, SerializesModels;
    public $carrito;
    public $idpedido;
    public $nombre;
    public $rut;
    public $giro;
    public $email;
    public $direccion;
    public $comuna;
    public $ciudad;
    public $telefono;
    public $totalsiniva;
    public $modo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($carrito,$idpedido,$nombre,$rut,$giro,$email,$direccion,$comuna,$ciudad,$telefono,$totalsiniva,$modo)
    {

        $this->carrito=$carrito;
        $this->idpedido=$idpedido;
        $this->nombre=$nombre;
        $this->rut=$rut;
        $this->giro=$giro;
        $this->email=$email;
        $this->direccion=$direccion;
        $this->comuna=$comuna;
        $this->ciudad=$ciudad;
        $this->telefono=$telefono;
        $this->totalsiniva=$totalsiniva;
        $this->modo=$modo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('web@storecenter.cl')
        ->view('carrito.correopedido');
    }
}
