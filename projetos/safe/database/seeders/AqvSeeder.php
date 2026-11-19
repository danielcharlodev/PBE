<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AqvSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'izete@gmail.com'],
            [
                'name' => 'Izete',
                'password' => Hash::make('izete123'),
                'role' => UserRole::AQV,
                'cpf' => null,
                'telefone' => null,
                'ativo' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
