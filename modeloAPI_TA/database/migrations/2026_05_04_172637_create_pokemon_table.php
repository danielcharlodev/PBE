<?php

use Illuminate\Database\Migrations\Migration; // Classe base para migrations (versionamento do banco)
use Illuminate\Database\Schema\Blueprint; // Objeto usado para definir colunas/índices da tabela
use Illuminate\Support\Facades\Schema; // Facade que executa operações de schema (create/table/drop)

return new class extends Migration // Retorna uma migration anônima (padrão Laravel)
{
    /**
     * Run the migrations.
     */
    public function up(): void // Executa a migration (aplica mudanças no banco)
    {
        Schema::create('pokemons', function (Blueprint $table) { // Cria a tabela "pokemons"
            $table->id(); // Coluna "id" (auto incremento, chave primária)
            $table->string('nome'); // Coluna texto curta para o nome
            $table->string('tipo'); // Coluna texto curta para o tipo
            $table->string('poder'); // Coluna texto curta para poder (aqui não está como número)
            $table->text('descricao'); // Coluna texto grande para descrição
            $table->string('foto')->nullable(); // Caminho da foto (pode ser nulo)
            $table->timestamps(); // Cria created_at e updated_at automaticamente
        }); // Fim da criação da tabela

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Desfaz a migration (rollback)
    {
        Schema::dropIfExists('pokemons'); // Remove a tabela se ela existir

    }
};
