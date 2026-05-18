<?php

namespace App\Listeners;

use App\Events\AlunoLiberado;
use Illuminate\Support\Facades\Log;

class EnviarNotificacaoResponsavel
{
    public function handle(AlunoLiberado $event): void
    {
        Log::info(
            'EMAIL enviado para responsável do aluno: ' .
            $event->solicitacao->aluno_nome
        );

        Log::info(
            'WHATSAPP enviado para responsável do aluno: ' .
            $event->solicitacao->aluno_nome
        );
    }
}