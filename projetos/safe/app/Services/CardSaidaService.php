<?php

namespace App\Services;

use App\Models\Aluno;
use App\Models\CardSaida;
use App\Models\Notificacao;
use App\Models\User;
use App\Support\UserRole;
use Illuminate\Support\Facades\DB;

class CardSaidaService
{
    public function criarSaida(Aluno $aluno, array $dados, int $aqvId): CardSaida
    {
        return $this->criar($aluno, [
            'tipo' => CardSaida::TIPO_SAIDA,
            'horario_saida' => $dados['horario_saida'],
            'horario_entrada' => null,
            'responsavel_autorizou' => $dados['responsavel_autorizou'],
            'qtd_faltas' => $dados['qtd_faltas'],
            'aulas_falta' => $dados['aulas_falta'],
        ], $aqvId);
    }

    public function criarEntradaAtrasada(Aluno $aluno, array $dados, int $aqvId): CardSaida
    {
        return $this->criar($aluno, [
            'tipo' => CardSaida::TIPO_ENTRADA_ATRASADA,
            'horario_saida' => null,
            'horario_entrada' => $dados['horario_entrada'],
            'responsavel_autorizou' => $dados['responsavel_autorizou'],
            'qtd_faltas' => $dados['qtd_faltas'] ?? 0,
            'aulas_falta' => $dados['aulas_falta'] ?? [],
        ], $aqvId);
    }

    private function criar(Aluno $aluno, array $dados, int $aqvId): CardSaida
    {
        return DB::transaction(function () use ($aluno, $dados, $aqvId) {
            $card = CardSaida::create([
                'aluno_id' => $aluno->id,
                'tipo' => $dados['tipo'],
                'diretor_id' => $aqvId,
                'horario_saida' => $dados['horario_saida'],
                'horario_entrada' => $dados['horario_entrada'],
                'responsavel_autorizou' => $dados['responsavel_autorizou'],
                'qtd_faltas' => $dados['qtd_faltas'],
                'aulas_falta' => $dados['aulas_falta'],
                'status' => CardSaida::STATUS_PENDENTE,
            ]);

            $aluno->load('curso.professores');
            $this->notificarProfessores($card, $aluno);
            $this->notificarPortaria($card, $aluno);

            return $card;
        });
    }

    private function notificarProfessores(CardSaida $card, Aluno $aluno): void
    {
        $professores = $aluno->curso?->professores ?? collect();

        if ($professores->isEmpty()) {
            $professores = $this->professoresPorNomeCursoLegado($aluno);
        }

        $nomeCurso = $aluno->curso?->nomeCompleto() ?? '—';

        foreach ($professores as $professor) {
            if ($card->isEntradaAtrasada()) {
                $titulo = 'Entrada atrasada — '.$aluno->nome_completo;
                $mensagem = sprintf(
                    'O aluno %s (%s) entrou às %s. Faltas por causa da entrada: %s. Responsável: %s.',
                    $aluno->nome_completo,
                    $nomeCurso,
                    $card->horarioEntradaFormatado(),
                    $card->aulasFaltaTexto(),
                    $card->responsavel_autorizou
                );
            } else {
                $titulo = 'Solicitação de saída — '.$aluno->nome_completo;
                $mensagem = sprintf(
                    'O aluno %s (%s) sairá às %s. Faltas registradas: %s.',
                    $aluno->nome_completo,
                    $nomeCurso,
                    $card->horarioSaidaFormatado(),
                    $card->aulasFaltaTexto()
                );
            }

            Notificacao::create([
                'user_id' => $professor->id,
                'card_saida_id' => $card->id,
                'tipo' => 'professor',
                'titulo' => $titulo,
                'mensagem' => $mensagem,
            ]);
        }
    }

    private function notificarPortaria(CardSaida $card, Aluno $aluno): void
    {
        $porteiros = User::query()->where('role', UserRole::PORTARIA)->get();
        $nomeCurso = $aluno->curso?->nomeCompleto() ?? '—';

        foreach ($porteiros as $porteiro) {
            if ($card->isEntradaAtrasada()) {
                $titulo = 'Entrada atrasada — '.$aluno->nome_completo;
                $mensagem = sprintf(
                    'Aluno: %s | Curso: %s | Entrou às %s | Faltas: %s. Aguardando liberação na portaria.',
                    $aluno->nome_completo,
                    $nomeCurso,
                    $card->horarioEntradaFormatado(),
                    $card->aulasFaltaTexto()
                );
            } else {
                $titulo = 'Solicitação de saída — '.$aluno->nome_completo;
                $mensagem = sprintf(
                    'Aluno: %s | Curso: %s | Horário: %s. Aguardando liberação na portaria.',
                    $aluno->nome_completo,
                    $nomeCurso,
                    $card->horarioSaidaFormatado()
                );
            }

            Notificacao::create([
                'user_id' => $porteiro->id,
                'card_saida_id' => $card->id,
                'tipo' => 'portaria',
                'titulo' => $titulo,
                'mensagem' => $mensagem,
            ]);
        }
    }

    private function professoresPorNomeCursoLegado(Aluno $aluno)
    {
        $nomeCurso = mb_strtolower(trim($aluno->curso?->nome ?? ''));

        if ($nomeCurso === '') {
            return collect();
        }

        return User::query()
            ->where('role', UserRole::PROFESSOR)
            ->where('ativo', true)
            ->whereRaw('LOWER(curso) = ?', [$nomeCurso])
            ->get();
    }
}
