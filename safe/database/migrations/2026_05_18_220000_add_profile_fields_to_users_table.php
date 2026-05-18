<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf', 11)->nullable()->unique()->after('email');
            $table->string('telefone', 20)->nullable()->after('cpf');
            $table->string('matricula', 30)->nullable()->unique()->after('telefone');
            $table->enum('turno', ['manha', 'tarde', 'noite', 'integral'])->nullable()->after('curso');
            $table->string('setor')->nullable()->after('turno');
            $table->boolean('ativo')->default(true)->after('setor');
            $table->foreignId('cadastrado_por')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['cadastrado_por']);
            $table->dropColumn([
                'cpf',
                'telefone',
                'matricula',
                'turno',
                'setor',
                'ativo',
                'cadastrado_por',
            ]);
        });
    }
};
