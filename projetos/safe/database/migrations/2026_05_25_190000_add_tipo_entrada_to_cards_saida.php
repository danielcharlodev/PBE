<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cards_saida', function (Blueprint $table) {
            $table->string('tipo', 30)->default('saida')->after('aluno_id');
            $table->time('horario_entrada')->nullable()->after('horario_saida');
        });

        DB::table('cards_saida')->whereNull('tipo')->update(['tipo' => 'saida']);
    }

    public function down(): void
    {
        Schema::table('cards_saida', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'horario_entrada']);
        });
    }
};
