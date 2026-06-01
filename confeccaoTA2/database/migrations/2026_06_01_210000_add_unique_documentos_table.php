<?php

use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Support\DocumentoBr;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Cliente::query()->each(function (Cliente $cliente): void {
            if ($cliente->documento) {
                $cliente->updateQuietly([
                    'documento' => DocumentoBr::apenasDigitos($cliente->documento),
                ]);
            }
        });

        Fornecedor::query()->each(function (Fornecedor $fornecedor): void {
            if ($fornecedor->cnpj) {
                $fornecedor->updateQuietly([
                    'cnpj' => DocumentoBr::apenasDigitos($fornecedor->cnpj),
                ]);
            }

            if ($fornecedor->telefone) {
                $fornecedor->updateQuietly([
                    'telefone' => DocumentoBr::apenasDigitos($fornecedor->telefone),
                ]);
            }
        });

        Cliente::query()->each(function (Cliente $cliente): void {
            if ($cliente->telefone) {
                $cliente->updateQuietly([
                    'telefone' => DocumentoBr::apenasDigitos($cliente->telefone),
                ]);
            }
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->unique('documento');
        });

        Schema::table('fornecedores', function (Blueprint $table) {
            $table->unique('cnpj');
        });
    }

    public function down(): void
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->dropUnique(['cnpj']);
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->dropUnique(['documento']);
        });
    }
};
