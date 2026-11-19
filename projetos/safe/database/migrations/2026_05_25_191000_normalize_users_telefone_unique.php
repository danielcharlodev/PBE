<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'telefone')) {
            return;
        }

        foreach (User::query()->whereNotNull('telefone')->get() as $usuario) {
            $usuario->update([
                'telefone' => User::normalizarTelefone((string) $usuario->telefone),
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->unique('telefone');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'telefone')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['telefone']);
        });
    }
};
