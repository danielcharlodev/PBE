<?php

use Illuminate\Database\Migrations\Migration; // Classe base para criar migrations
use Illuminate\Database\Schema\Blueprint; // Usado para definir alterações na tabela
use Illuminate\Support\Facades\Schema; // Facade para manipular schema do banco

return new class extends Migration // Migration anônima (padrão do Laravel)
{
    public function up(): void // Aplica a mudança no banco
    {
        Schema::table('pokemons', function (Blueprint $table): void { // Altera a tabela existente "pokemons"
            $table->json('ataques')->nullable()->after('foto'); // Adiciona coluna JSON "ataques" depois de "foto" (pode ser nula)
        }); // Fim da alteração da tabela
    }

    public function down(): void // Desfaz a mudança (rollback)
    {
        Schema::table('pokemons', function (Blueprint $table): void { // Altera a tabela "pokemons"
            $table->dropColumn('ataques'); // Remove a coluna "ataques"
        }); // Fim do rollback da tabela
    }
};
