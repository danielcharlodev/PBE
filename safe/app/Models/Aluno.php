<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aluno extends Model
{
    protected $fillable = [
        'nome_completo',
        'cpf',
        'idade',
        'responsavel_nome',
        'responsavel_telefone',
        'curso',
        'cadastrado_por',
    ];

    protected function casts(): array
    {
        return [
            'idade' => 'integer',
        ];
    }

    public function cadastradoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cadastrado_por');
    }

    public function cardsSaida(): HasMany
    {
        return $this->hasMany(CardSaida::class, 'aluno_id');
    }

    public function getCpfFormatadoAttribute(): string
    {
        $cpf = preg_replace('/\D/', '', $this->cpf);

        if (strlen($cpf) !== 11) {
            return $this->cpf;
        }

        return substr($cpf, 0, 3).'.'
            .substr($cpf, 3, 3).'.'
            .substr($cpf, 6, 3).'-'
            .substr($cpf, 9, 2);
    }

    public static function normalizarCpf(string $cpf): string
    {
        return preg_replace('/\D/', '', $cpf);
    }
}
