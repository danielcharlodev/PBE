<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    public const TIPOS = [
        'cai' => 'CAI',
        'tecnico' => 'TECNICO',
        'fic' => 'FIC',
    ];

    protected $fillable = [
        'nome',
        'tipo',
        'vagas',
        'cadastrado_por',
    ];

    protected function casts(): array
    {
        return [
            'vagas' => 'integer',
        ];
    }

    public function cadastradoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cadastrado_por');
    }

    public function professores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'curso_professor')
            ->withTimestamps();
    }

    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class, 'curso_id');
    }

    public function tipoLabel(): string
    {
        return self::TIPOS[$this->tipo] ?? strtoupper((string) $this->tipo);
    }

    public function nomeCompleto(): string
    {
        return $this->nome.' ('.$this->tipoLabel().')';
    }
}
