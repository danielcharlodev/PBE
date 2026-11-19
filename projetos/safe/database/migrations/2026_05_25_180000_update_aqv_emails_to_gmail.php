<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        $izete = User::query()->where('email', 'izete@safe.com')->first();

        if ($izete) {
            $izete->update([
                'email' => 'izete@gmail.com',
                'cpf' => null,
                'telefone' => null,
            ]);
        } elseif (! User::query()->where('email', 'izete@gmail.com')->exists()) {
            User::query()->updateOrCreate(
                ['email' => 'izete@gmail.com'],
                [
                    'name' => 'Izete',
                    'password' => \Illuminate\Support\Facades\Hash::make('izete123'),
                    'role' => 'aqv',
                    'ativo' => true,
                    'email_verified_at' => now(),
                ]
            );
        } else {
            User::query()
                ->where('email', 'izete@gmail.com')
                ->update(['cpf' => null, 'telefone' => null]);
        }

        $aqv = User::query()->where('email', 'aqv@safe.com')->first();

        if ($aqv) {
            $aqv->update(['email' => 'aqv@gmail.com']);
        }
    }

    public function down(): void
    {
        //
    }
};
