<?php

use Illuminate\Database\Migrations\Migration; // Base para migrations (controle de versão do banco)
use Illuminate\Database\Schema\Blueprint; // Ajuda a definir colunas/índices
use Illuminate\Support\Facades\Schema; // Operações de schema (create/drop)

return new class extends Migration // Migration anônima
{
    /**
     * Run the migrations.
     */
    public function up(): void // Aplica as tabelas padrão de autenticação/sessão
    {
        Schema::create('users', function (Blueprint $table) { // Cria tabela de usuários
            $table->id(); // Id (auto incremento)
            $table->string('name'); // Nome do usuário
            $table->string('email')->unique(); // E-mail (único)
            $table->timestamp('email_verified_at')->nullable(); // Data/hora de verificação do e-mail (opcional)
            $table->string('password'); // Senha (hash)
            $table->rememberToken(); // Token para “lembrar login”
            $table->timestamps(); // created_at / updated_at
        }); // Fim da tabela users

        Schema::create('password_reset_tokens', function (Blueprint $table) { // Tabela para reset de senha
            $table->string('email')->primary(); // E-mail como chave primária
            $table->string('token'); // Token de reset
            $table->timestamp('created_at')->nullable(); // Quando foi gerado
        }); // Fim da tabela password_reset_tokens

        Schema::create('sessions', function (Blueprint $table) { // Tabela para sessões (quando usa driver database)
            $table->string('id')->primary(); // Id da sessão
            $table->foreignId('user_id')->nullable()->index(); // Usuário (se logado)
            $table->string('ip_address', 45)->nullable(); // IP (IPv4/IPv6)
            $table->text('user_agent')->nullable(); // Navegador/dispositivo
            $table->longText('payload'); // Dados da sessão
            $table->integer('last_activity')->index(); // Última atividade (timestamp)
        }); // Fim da tabela sessions
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Desfaz (rollback) removendo as tabelas
    {
        Schema::dropIfExists('users'); // Remove users
        Schema::dropIfExists('password_reset_tokens'); // Remove tokens de reset
        Schema::dropIfExists('sessions'); // Remove sessões
    }
};
