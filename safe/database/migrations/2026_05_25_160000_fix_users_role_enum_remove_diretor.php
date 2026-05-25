<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
            return;
        }

        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            DB::table('users')->where('role', 'diretor')->update(['role' => 'aqv']);

            return;
        }

        // Permite gravar 'aqv' antes de remover 'diretor' do ENUM.
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('diretor', 'aqv', 'professor', 'portaria') NOT NULL DEFAULT 'professor'");

        DB::table('users')->where('role', 'diretor')->update(['role' => 'aqv']);

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('aqv', 'professor', 'portaria') NOT NULL DEFAULT 'professor'");
    }

    public function down(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
            return;
        }

        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('diretor', 'aqv', 'professor', 'portaria') NOT NULL DEFAULT 'professor'");
        DB::table('users')->where('role', 'aqv')->update(['role' => 'diretor']);
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('diretor', 'professor', 'portaria') NOT NULL DEFAULT 'professor'");
    }
};
