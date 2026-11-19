<?php

use Illuminate\Database\Migrations\Migration; // Base para migrations
use Illuminate\Database\Schema\Blueprint; // Define colunas/índices
use Illuminate\Support\Facades\Schema; // Opera no schema do banco

return new class extends Migration // Migration anônima
{
    /**
     * Run the migrations.
     */
    public function up(): void // Cria tabelas de filas/jobs (se usar queue com driver database)
    {
        Schema::create('jobs', function (Blueprint $table) { // Tabela de jobs pendentes
            $table->id(); // Id do job
            $table->string('queue')->index(); // Nome da fila
            $table->longText('payload'); // Conteúdo do job (serializado)
            $table->unsignedTinyInteger('attempts'); // Número de tentativas
            $table->unsignedInteger('reserved_at')->nullable(); // Quando o worker reservou o job
            $table->unsignedInteger('available_at'); // Quando fica disponível para rodar
            $table->unsignedInteger('created_at'); // Quando foi criado
        }); // Fim da tabela jobs

        Schema::create('job_batches', function (Blueprint $table) { // Tabela para batches (lotes de jobs)
            $table->string('id')->primary(); // Id do batch
            $table->string('name'); // Nome do batch
            $table->integer('total_jobs'); // Total de jobs no batch
            $table->integer('pending_jobs'); // Quantos ainda faltam
            $table->integer('failed_jobs'); // Quantos falharam
            $table->longText('failed_job_ids'); // Lista de ids que falharam
            $table->mediumText('options')->nullable(); // Opções do batch (json serializado)
            $table->integer('cancelled_at')->nullable(); // Quando foi cancelado
            $table->integer('created_at'); // Quando foi criado
            $table->integer('finished_at')->nullable(); // Quando finalizou
        }); // Fim da tabela job_batches

        Schema::create('failed_jobs', function (Blueprint $table) { // Tabela para jobs que falharam
            $table->id(); // Id
            $table->string('uuid')->unique(); // UUID único do job
            $table->text('connection'); // Conexão/driver usado
            $table->text('queue'); // Nome da fila
            $table->longText('payload'); // Conteúdo do job
            $table->longText('exception'); // Stacktrace/erro da exceção
            $table->timestamp('failed_at')->useCurrent(); // Quando falhou
        }); // Fim da tabela failed_jobs
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Remove as tabelas de jobs
    {
        Schema::dropIfExists('jobs'); // Remove jobs
        Schema::dropIfExists('job_batches'); // Remove batches
        Schema::dropIfExists('failed_jobs'); // Remove falhas
    }
};
