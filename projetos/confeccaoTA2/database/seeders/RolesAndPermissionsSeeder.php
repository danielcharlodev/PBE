<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissoes = [
            'acessar_clientes',
            'acessar_fornecedores',
            'acessar_insumos',
            'acessar_produtos',
            'acessar_pedidos',
            'acessar_movimentacoes',
        ];

        foreach ($permissoes as $permissao) {
            Permission::query()->firstOrCreate(
                ['name' => $permissao, 'guard_name' => 'web'],
            );
        }

        $admin = Role::query()->firstOrCreate(
            ['name' => 'Admin', 'guard_name' => 'web'],
        );

        $admin->syncPermissions(Permission::all());

        $gerente = Role::query()->firstOrCreate(
            ['name' => 'Gerente Comercial', 'guard_name' => 'web'],
        );

        $gerente->syncPermissions(
            Permission::query()->whereIn('name', $permissoes)->get(),
        );

        User::query()
            ->where('email', 'admin@confeccao.com')
            ->each(fn (User $user) => $user->syncRoles(['Admin']));

        User::query()
            ->whereDoesntHave('roles')
            ->where('email', '!=', 'admin@confeccao.com')
            ->each(fn (User $user) => $user->syncRoles(['Gerente Comercial']));
    }
}
