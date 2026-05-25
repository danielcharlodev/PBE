<?php

namespace App\Models;

use App\Support\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'cpf',
    'telefone',
    'matricula',
    'curso',
    'turno',
    'setor',
    'ativo',
    'cadastrado_por',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const TURNOS = [
        'manha' => 'Manhã',
        'tarde' => 'Tarde',
        'noite' => 'Noite',
        'integral' => 'Integral',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'ativo' => 'boolean',
        ];
    }

    public function cadastradoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cadastrado_por');
    }

    public function cursosEnsino(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class, 'curso_professor')
            ->withTimestamps();
    }

    public function scopeEquipe(Builder $query): Builder
    {
        return $query->whereIn('role', UserRole::EQUIPE);
    }

    public function scopeAtivos(Builder $query): Builder
    {
        return $query->where('ativo', true);
    }

    public static function normalizarCpf(string $cpf): string
    {
        return preg_replace('/\D/', '', $cpf);
    }

    public static function normalizarTelefone(string $telefone): string
    {
        return preg_replace('/\D/', '', $telefone);
    }

    public function getTelefoneFormatadoAttribute(): ?string
    {
        if (! $this->telefone) {
            return null;
        }

        $tel = self::normalizarTelefone($this->telefone);

        if (strlen($tel) === 11) {
            return '('.substr($tel, 0, 2).') '.substr($tel, 2, 5).'-'.substr($tel, 7, 4);
        }

        if (strlen($tel) === 10) {
            return '('.substr($tel, 0, 2).') '.substr($tel, 2, 4).'-'.substr($tel, 6, 4);
        }

        return $this->telefone;
    }

    public function getCpfFormatadoAttribute(): ?string
    {
        if (! $this->cpf) {
            return null;
        }

        $cpf = preg_replace('/\D/', '', $this->cpf);

        if (strlen($cpf) !== 11) {
            return $this->cpf;
        }

        return substr($cpf, 0, 3).'.'
            .substr($cpf, 3, 3).'.'
            .substr($cpf, 6, 3).'-'
            .substr($cpf, 9, 2);
    }

    public function cargoLabel(): string
    {
        return UserRole::label($this->role ?? '');
    }

    public function turnoLabel(): ?string
    {
        return $this->turno ? (self::TURNOS[$this->turno] ?? $this->turno) : null;
    }
}
