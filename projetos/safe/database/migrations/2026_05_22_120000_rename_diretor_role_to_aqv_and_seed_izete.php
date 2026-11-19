<?php

use App\Models\User;
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

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('diretor', 'aqv', 'professor', 'portaria') NOT NULL DEFAULT 'professor'");
            DB::table('users')->where('role', 'diretor')->update(['role' => 'aqv']);
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('aqv', 'professor', 'portaria') NOT NULL DEFAULT 'professor'");
        } else {
            DB::table('users')->where('role', 'diretor')->update(['role' => 'aqv']);
        }

        User::query()->updateOrCreate(
            ['email' => 'izete@gmail.com'],
            [
                'name' => 'Izete',
                'password' => \Illuminate\Support\Facades\Hash::make('izete123'),
                'role' => 'aqv',
                'ativo' => true,
                'email_verified_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
            return;
        }

        User::query()->where('email', 'izete@gmail.com')->delete();

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('diretor', 'aqv', 'professor', 'portaria') NOT NULL DEFAULT 'professor'");
        }

        DB::table('users')->where('role', 'aqv')->update(['role' => 'diretor']);

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('diretor', 'professor', 'portaria') NOT NULL DEFAULT 'professor'");
        }
    }
};
