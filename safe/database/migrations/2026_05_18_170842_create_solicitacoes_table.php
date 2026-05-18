<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
    $table->id();

    $table->string('aluno_nome');
    $table->string('motivo');

    $table->enum('tipo', ['entrada_atrasada', 'saida_antecipada']);

    $table->string('status')->default('pendente');

    $table->foreignId('responsavel_id')->constrained('users');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};
