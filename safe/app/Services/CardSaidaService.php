<?php

namespace App\Services;

use App\Models\Aluno;
use App\Models\CardSaida;
use App\Models\Notificacao;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CardSaidaService
{
    public function criar(Aluno $aluno, array $dados, int $diretorId): CardSaida
    {
        return DB::transaction(function () use ($aluno, $dados, $diretorId) {
            $card = CardSaida::create([
                'aluno_id' => $aluno->id,
                'diretor_id' => $diretorId,
                'horario_saida' => $dados['horario_saida'],
                'responsavel_autorizou' => $dados['responsavel_autorizou'],
                'qtd_faltas' => $dados['qtd_faltas'],
                'aulas_falta' => $dados['aulas_falta'],
                'status' => CardSaida::STATUS_PENDENTE,
            ]);

            $this->notificarProfessores($card, $aluno);
            $this->notificarPortaria($card, $aluno);

            return $card;
        });
    }

    private function notificarProfessores(CardSaida $card, Aluno $aluno): void
    {
        $professores = User::query()
            ->where('role', 'professor')
            ->whereRaw('LOWER(curso) = ?', [mb_strtolower(trim($aluno->curso))])
            ->get();

        foreach ($professores as $professor) {
            Notificacao::create([
                'user_id' => $professor->id,
                'card_saida_id' => $card->id,
                'tipo' => 'professor',
                'titulo' => 'Saída autorizada — '.$aluno->nome_completo,
                'mensagem' => sprintf(
                    "O aluno %s (%s) sairá às %s. Faltas registradas: %s.",
                    $aluno->nome_completo,
                    $aluno->curso,
                    $card->horarioSaidaFormatado(),
                    $card->aulasFaltaTexto()
                ),
            ]);
        }
    }

    private function notificarPortaria(CardSaida $card, Aluno $aluno): void
    {
        $porteiros = User::query()->where('role', 'portaria')->get();

        foreach ($porteiros as $porteiro) {
            Notificacao::create([
                'user_id' => $porteiro->id,
                'card_saida_id' => $card->id,
                'tipo' => 'portaria',
                'titulo' => 'Liberação na portaria — '.$aluno->nome_completo,
                'mensagem' => sprintf(
                    'Aluno: %s | Curso: %s | Horário de saída: %s. Aguardando liberação no portão.',
                    $aluno->nome_completo,
                    $aluno->curso,
                    $card->horarioSaidaFormatado()
                ),
            ]);
        }
    }
}
