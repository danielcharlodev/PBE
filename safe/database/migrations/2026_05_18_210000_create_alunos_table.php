<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('cpf', 11)->unique();
            $table->unsignedTinyInteger('idade');
            $table->string('responsavel_nome');
            $table->string('responsavel_telefone', 20);
            $table->string('curso');
            $table->foreignId('cadastrado_por')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
