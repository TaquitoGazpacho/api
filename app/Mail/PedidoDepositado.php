<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PedidoDepositado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $clave;
    protected $nombre;
    protected $oficina;
    protected $taquilla;

    public function __construct($nombre, $clave, $oficina, $taquilla)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->oficina = $oficina;
        $this->taquilla = $taquilla;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.pedidoDepositado')->with([
            'nombre' => $this->nombre,
            'clave' => $this->clave,
            'oficina' => $this->oficina,
            'taquilla' => $this->taquilla,
        ]);
    }
}
