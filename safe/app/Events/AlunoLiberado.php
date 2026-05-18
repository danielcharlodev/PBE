<?php

namespace App\Events;

use App\Models\Solicitacao;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlunoLiberado
{
    use Dispatchable, SerializesModels;

    public $solicitacao;

    /**
     * Create a new event instance.
     */
    public function __construct(Solicitacao $solicitacao)
    {
        $this->solicitacao = $solicitacao;
    }
}