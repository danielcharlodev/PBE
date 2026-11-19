<?php

namespace App\Mail;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoCriadoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Pedido $pedido)
    {
        $this->pedido->loadMissing(['cliente', 'produto']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pedido de Confecção Recebido com Sucesso! 🎉',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido-criado',
        );
    }
}
