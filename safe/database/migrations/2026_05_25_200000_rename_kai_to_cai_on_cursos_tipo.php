<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('cursos') || ! Schema::hasColumn('cursos', 'tipo')) {
            return;
        }

        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            DB::table('cursos')->where('tipo', 'kai')->update(['tipo' => 'cai']);

            return;
        }

        DB::statement("ALTER TABLE cursos MODIFY COLUMN tipo ENUM('kai', 'cai', 'tecnico', 'fic') NOT NULL");

        DB::table('cursos')->where('tipo', 'kai')->update(['tipo' => 'cai']);

        DB::statement("ALTER TABLE cursos MODIFY COLUMN tipo ENUM('cai', 'tecnico', 'fic') NOT NULL");
    }

    public function down(): void
    {
        if (! Schema::hasTable('cursos') || ! Schema::hasColumn('cursos', 'tipo')) {
            return;
        }

        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            DB::table('cursos')->where('tipo', 'cai')->update(['tipo' => 'kai']);

            return;
        }

        DB::statement("ALTER TABLE cursos MODIFY COLUMN tipo ENUM('kai', 'cai', 'tecnico', 'fic') NOT NULL");

        DB::table('cursos')->where('tipo', 'cai')->update(['tipo' => 'kai']);

        DB::statement("ALTER TABLE cursos MODIFY COLUMN tipo ENUM('kai', 'tecnico', 'fic') NOT NULL");
    }
};
