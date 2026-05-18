<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
            return;
        }

        User::query()->updateOrCreate(
            ['email' => 'diretor@safe.com'],
            [
                'name' => 'Direção Escolar',
                'password' => 'diretor123',
                'role' => 'diretor',
                'ativo' => true,
                'email_verified_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        //
    }
};
