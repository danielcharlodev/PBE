<?php

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->foreignId('curso_id')->nullable()->after('responsavel_telefone')->constrained('cursos')->nullOnDelete();
        });

        if (! Schema::hasColumn('alunos', 'curso')) {
            return;
        }

        $aqvId = \App\Models\User::query()
            ->where('role', 'aqv')
            ->value('id');

        foreach (Aluno::query()->whereNull('curso_id')->get() as $aluno) {
            $nome = trim((string) $aluno->curso);
            if ($nome === '') {
                continue;
            }

            $curso = Curso::query()->firstOrCreate(
                ['nome' => $nome, 'tipo' => 'tecnico'],
                [
                    'vagas' => 30,
                    'cadastrado_por' => $aqvId,
                ]
            );

            $aluno->update(['curso_id' => $curso->id]);
        }

        Schema::table('alunos', function (Blueprint $table) {
            $table->dropColumn('curso');
        });
    }

    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->string('curso')->nullable();
        });

        foreach (Aluno::with('curso')->get() as $aluno) {
            $aluno->update(['curso' => $aluno->curso?->nome ?? '']);
        }

        Schema::table('alunos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('curso_id');
        });
    }
};
