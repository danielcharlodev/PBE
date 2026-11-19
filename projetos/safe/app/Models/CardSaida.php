<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardSaida extends Model
{
    public const STATUS_PENDENTE = 'pendente';

    public const STATUS_LIBERADO = 'liberado';

    public const TOTAL_AULAS = 5;

    public const TIPO_SAIDA = 'saida';

    public const TIPO_ENTRADA_ATRASADA = 'entrada_atrasada';

    protected $table = 'cards_saida';

    protected $fillable = [
        'aluno_id',
        'tipo',
        'diretor_id',
        'horario_saida',
        'horario_entrada',
        'responsavel_autorizou',
        'qtd_faltas',
        'aulas_falta',
        'status',
        'liberado_em',
        'liberado_por',
    ];

    protected function casts(): array
    {
        return [
            'aulas_falta' => 'array',
            'liberado_em' => 'datetime',
            'qtd_faltas' => 'integer',
        ];
    }

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function diretor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diretor_id');
    }

    public function liberadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'liberado_por');
    }

    public function notificacoes(): HasMany
    {
        return $this->hasMany(Notificacao::class, 'card_saida_id');
    }

    public function podeLiberar(): bool
    {
        return $this->status === self::STATUS_PENDENTE;
    }

    public function isEntradaAtrasada(): bool
    {
        return $this->tipo === self::TIPO_ENTRADA_ATRASADA;
    }

    public function tipoLabel(): string
    {
        return $this->isEntradaAtrasada() ? 'Entrada atrasada' : 'Saída antecipada';
    }

    public function horarioSaidaFormatado(): string
    {
        return $this->formatarHorario($this->horario_saida);
    }

    public function horarioEntradaFormatado(): string
    {
        return $this->formatarHorario($this->horario_entrada);
    }

    public function horarioPrincipalFormatado(): string
    {
        return $this->isEntradaAtrasada()
            ? $this->horarioEntradaFormatado()
            : $this->horarioSaidaFormatado();
    }

    private function formatarHorario(mixed $horario): string
    {
        if (! $horario) {
            return '—';
        }

        return date('H:i', strtotime((string) $horario));
    }

    public function aulasRegistroTexto(): string
    {
        if ($this->isEntradaAtrasada()) {
            if (empty($this->aulas_falta)) {
                return $this->qtd_faltas === 0 ? 'Nenhuma aula indicada' : $this->qtd_faltas.' aula(s)';
            }

            return collect($this->aulas_falta)
                ->map(fn ($n) => 'Aula '.$n)
                ->implode(', ');
        }

        return $this->aulasFaltaTexto();
    }

    public function aulasFaltaTexto(): string
    {
        if (empty($this->aulas_falta)) {
            return $this->qtd_faltas === 0 ? 'Nenhuma falta' : $this->qtd_faltas.' falta(s)';
        }

        $aulas = collect($this->aulas_falta)
            ->map(fn ($n) => 'Aula '.$n)
            ->implode(', ');

        return $aulas.' ('.$this->qtd_faltas.' falta(s))';
    }
}
