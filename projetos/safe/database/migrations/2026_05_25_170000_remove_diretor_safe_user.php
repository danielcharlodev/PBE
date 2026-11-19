<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        $diretor = User::query()->where('email', 'diretor@safe.com')->first();

        if (! $diretor) {
            return;
        }

        $aqv = User::query()->where('email', 'izete@gmail.com')->first();

        if ($aqv) {
            if (Schema::hasTable('cards_saida')) {
                DB::table('cards_saida')
                    ->where('diretor_id', $diretor->id)
                    ->update(['diretor_id' => $aqv->id]);

                DB::table('cards_saida')
                    ->where('liberado_por', $diretor->id)
                    ->update(['liberado_por' => $aqv->id]);
            }

            if (Schema::hasTable('alunos')) {
                DB::table('alunos')
                    ->where('cadastrado_por', $diretor->id)
                    ->update(['cadastrado_por' => $aqv->id]);
            }

            if (Schema::hasTable('cursos')) {
                DB::table('cursos')
                    ->where('cadastrado_por', $diretor->id)
                    ->update(['cadastrado_por' => $aqv->id]);
            }

            DB::table('users')
                ->where('cadastrado_por', $diretor->id)
                ->update(['cadastrado_por' => $aqv->id]);
        }

        $diretor->delete();
    }

    public function down(): void
    {
        //
    }
};
