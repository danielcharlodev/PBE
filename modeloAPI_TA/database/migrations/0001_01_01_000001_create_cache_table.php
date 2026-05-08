<?php

use Illuminate\Database\Migrations\Migration; // Base para migrations
use Illuminate\Database\Schema\Blueprint; // Define colunas/índices
use Illuminate\Support\Facades\Schema; // Opera no schema do banco

return new class extends Migration // Migration anônima
{
    /**
     * Run the migrations.
     */
    public function up(): void // Cria tabelas de cache (se o cache usar banco)
    {
        Schema::create('cache', function (Blueprint $table) { // Tabela que armazena itens de cache
            $table->string('key')->primary(); // Chave do cache
            $table->mediumText('value'); // Valor serializado
            $table->bigInteger('expiration')->index(); // Quando expira
        }); // Fim da tabela cache

        Schema::create('cache_locks', function (Blueprint $table) { // Tabela para locks do cache (controle de concorrência)
            $table->string('key')->primary(); // Chave do lock
            $table->string('owner'); // Quem “possui” o lock
            $table->bigInteger('expiration')->index(); // Quando expira
        }); // Fim da tabela cache_locks
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Remove as tabelas de cache
    {
        Schema::dropIfExists('cache'); // Remove cache
        Schema::dropIfExists('cache_locks'); // Remove locks
    }
};
