<?php

namespace App\Filament\Resources\Pedidos\Concerns;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Validation\ValidationException;

trait ValidaEstoquePedido
{
    protected function validarEstoquePedido(array $data, ?Pedido $pedidoExistente = null): void
    {
        if (empty($data['produto_id'])) {
            return;
        }

        $quantidade = max(1, (int) ($data['quantidade'] ?? 1));
        $produto = Produto::query()->find($data['produto_id']);

        if (! $produto) {
            return;
        }

        $disponivel = (int) $produto->estoque;

        if ($pedidoExistente?->movimentacaoEstoque) {
            $disponivel += (int) $pedidoExistente->movimentacaoEstoque->quantidade;
        }

        if ($quantidade > $disponivel) {
            throw ValidationException::withMessages([
                'quantidade' => "Estoque insuficiente. Disponível: {$disponivel} unidade(s).",
            ]);
        }
    }
}
