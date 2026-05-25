<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('cards_saida') || ! Schema::hasColumn('cards_saida', 'horario_saida')) {
            return;
        }

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE cards_saida MODIFY horario_saida TIME NULL');

            return;
        }

        Schema::table('cards_saida', function ($table) {
            $table->time('horario_saida')->nullable()->change();
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('cards_saida') || ! Schema::hasColumn('cards_saida', 'horario_saida')) {
            return;
        }

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE cards_saida MODIFY horario_saida TIME NOT NULL');

            return;
        }

        Schema::table('cards_saida', function ($table) {
            $table->time('horario_saida')->nullable(false)->change();
        });
    }
};
