<?php

namespace App\Listeners;

use App\Events\CardSaidaLiberado;
use Illuminate\Support\Facades\Log;

class NotificarResponsavelSaida
{
    public function handle(CardSaidaLiberado $event): void
    {
        $card = $event->card->loadMissing('aluno');
        $aluno = $card->aluno;

        if (! $aluno) {
            return;
        }

        Log::info('SENAI - Notificação ao responsável (e-mail simulado)', [
            'aluno' => $aluno->nome_completo,
            'responsavel' => $aluno->responsavel_nome,
            'telefone' => $aluno->responsavel_telefone,
            'horario_saida' => $card->horarioSaidaFormatado(),
        ]);

        Log::info('SENAI - Notificação ao responsável (WhatsApp simulado)', [
            'aluno' => $aluno->nome_completo,
            'telefone' => $aluno->responsavel_telefone,
        ]);
    }
}
