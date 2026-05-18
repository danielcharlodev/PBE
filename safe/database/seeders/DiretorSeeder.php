<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DiretorSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'diretor@safe.com'],
            [
                'name' => 'Direção Escolar',
                'password' => 'diretor123',
                'role' => 'diretor',
                'cpf' => '11144477735',
                'telefone' => '(11) 3000-0000',
                'ativo' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
