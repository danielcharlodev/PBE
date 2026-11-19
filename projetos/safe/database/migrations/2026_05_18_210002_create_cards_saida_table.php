<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cards_saida', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos')->cascadeOnDelete();
            $table->foreignId('diretor_id')->constrained('users')->cascadeOnDelete();
            $table->time('horario_saida')->nullable();
            $table->string('responsavel_autorizou');
            $table->unsignedTinyInteger('qtd_faltas')->default(0);
            $table->json('aulas_falta')->nullable();
            $table->string('status')->default('pendente');
            $table->timestamp('liberado_em')->nullable();
            $table->foreignId('liberado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards_saida');
    }
};
