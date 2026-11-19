<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class EnsureAdminUserCommand extends Command
{
    protected $signature = 'confeccao:ensure-admin {email=admin@confeccao.com}';

    protected $description = 'Atribui o cargo Admin ao usuário informado (restaura acesso ao menu)';

    public function handle(): int
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->callSilent('db:seed', ['--class' => 'Database\\Seeders\\RolesAndPermissionsSeeder', '--force' => true]);

        $user = User::query()->where('email', $this->argument('email'))->first();

        if (! $user) {
            $this->error("Usuário não encontrado: {$this->argument('email')}");

            return self::FAILURE;
        }

        $adminRole = Role::query()->where('name', 'Admin')->first();

        if (! $adminRole) {
            $this->error('Cargo Admin não existe. Rode: php artisan db:seed --class=RolesAndPermissionsSeeder');

            return self::FAILURE;
        }

        $user->syncRoles(['Admin']);

        $this->info("Cargo Admin atribuído a {$user->email}. Faça logout e login novamente.");

        return self::SUCCESS;
    }
}
