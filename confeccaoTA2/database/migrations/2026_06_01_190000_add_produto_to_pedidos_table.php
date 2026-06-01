<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('produto_id')
                ->nullable()
                ->after('cliente_id')
                ->constrained('produtos')
                ->nullOnDelete();

            $table->unsignedInteger('quantidade')
                ->default(1)
                ->after('produto_id');
        });

        $itens = DB::table('item_pedidos')
            ->select('pedido_id', 'produto_id', 'quantidade', 'preco_unitario')
            ->orderBy('id')
            ->get()
            ->groupBy('pedido_id');

        foreach ($itens as $pedidoId => $pedidoItens) {
            $item = $pedidoItens->first();

            DB::table('pedidos')
                ->where('id', $pedidoId)
                ->update([
                    'produto_id' => $item->produto_id,
                    'quantidade' => $item->quantidade,
                    'valor_total' => $item->quantidade * $item->preco_unitario,
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
            $table->dropColumn(['produto_id', 'quantidade']);
        });
    }
};
