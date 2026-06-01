<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Insumo;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@confeccao.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
            ],
        );

        $this->call(RolesAndPermissionsSeeder::class);

        Cliente::query()->firstOrCreate(
            ['email' => 'cliente@exemplo.com'],
            [
                'nome' => 'Cliente Exemplo',
                'telefone' => '(11) 99999-0000',
                'documento' => '000.000.000-00',
            ],
        );

        Fornecedor::query()->firstOrCreate(
            ['cnpj' => '00.000.000/0001-00'],
            [
                'nome' => 'Fornecedor Exemplo Ltda',
                'email' => 'contato@fornecedor.com',
                'telefone' => '(11) 3333-0000',
            ],
        );

        Insumo::query()->firstOrCreate(
            ['nome' => 'Tecido Algodão'],
            [
                'unidade_medida' => 'Metros',
                'preco_custo' => 25.90,
                'estoque' => 100,
            ],
        );

        Produto::query()->firstOrCreate(
            ['referencia' => 'CAM-001'],
            [
                'nome' => 'Camiseta Básica',
                'preco_venda' => 49.90,
                'estoque' => 50,
            ],
        );
    }
}
