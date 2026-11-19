<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('solicitacoes')) {
            return;
        }

        DB::table('solicitacoes')->where('tipo', 'entrada')->update(['tipo' => 'entrada_atrasada']);
        DB::table('solicitacoes')->where('tipo', 'saida')->update(['tipo' => 'saida_antecipada']);

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE solicitacoes MODIFY tipo ENUM('entrada_atrasada', 'saida_antecipada') NOT NULL");
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('solicitacoes')) {
            return;
        }

        DB::table('solicitacoes')->where('tipo', 'entrada_atrasada')->update(['tipo' => 'entrada']);
        DB::table('solicitacoes')->where('tipo', 'saida_antecipada')->update(['tipo' => 'saida']);

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE solicitacoes MODIFY tipo ENUM('entrada', 'saida') NOT NULL");
        }
    }
};
