<?php

namespace App\Models; // Namespace padrão dos models

// use Illuminate\Contracts\Auth\MustVerifyEmail; // Interface para e-mail verificado (desativado aqui)
use Database\Factories\UserFactory; // Factory usada para criar usuários fake em testes/seeds
use Illuminate\Database\Eloquent\Attributes\Fillable; // Attribute para definir quais campos podem ser preenchidos
use Illuminate\Database\Eloquent\Attributes\Hidden; // Attribute para esconder campos em arrays/JSON
use Illuminate\Database\Eloquent\Factories\HasFactory; // Trait para habilitar factories no model
use Illuminate\Foundation\Auth\User as Authenticatable; // Base de usuário autenticável (login/sessão)
use Illuminate\Notifications\Notifiable; // Trait para permitir notificações (mail, database, etc.)

#[Fillable(['name', 'email', 'password'])] // Permite mass assignment nesses campos
#[Hidden(['password', 'remember_token'])] // Esconde esses campos quando serializa (segurança)
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable; // Ativa factories e notificações

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [ // Define conversões automáticas de tipos/casts
            'email_verified_at' => 'datetime', // Trata a coluna como data/hora
            'password' => 'hashed', // Sempre que setar senha, o Laravel faz hash automaticamente
        ]; // Fim dos casts
    }
}
