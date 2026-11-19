<?php

namespace App\Services;

use App\Models\MovimentacaoEstoque;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PedidoEstoqueService
{
    public static function sincronizarComStatus(Pedido $pedido, ?string $statusAnterior = null): ?MovimentacaoEstoque
    {
        $pedido->loadMissing(['cliente', 'produto']);

        if ($pedido->status === 'Finalizado') {
            return self::registrarSaida($pedido);
        }

        if ($statusAnterior === 'Finalizado') {
            self::cancelarSaida($pedido);
        }

        return null;
    }

    public static function registrarSaida(Pedido $pedido): ?MovimentacaoEstoque
    {
        if (! $pedido->produto_id) {
            return null;
        }

        $pedido->loadMissing(['cliente', 'produto', 'movimentacaoEstoque']);

        $quantidade = max(1, (int) $pedido->quantidade);

        if ($quantidade > $pedido->estoqueDisponivel()) {
            throw ValidationException::withMessages([
                'quantidade' => 'Estoque insuficiente para finalizar este pedido.',
            ]);
        }

        return DB::transaction(function () use ($pedido, $quantidade): MovimentacaoEstoque {
            $existente = MovimentacaoEstoque::query()
                ->where('pedido_id', $pedido->id)
                ->first();

            if ($existente) {
                $existente->delete();
            }

            return MovimentacaoEstoque::query()->create([
                'pedido_id' => $pedido->id,
                'produto_id' => $pedido->produto_id,
                'tipo' => 'saida',
                'quantidade' => $quantidade,
                'observacao' => self::montarObservacao($pedido),
            ]);
        });
    }

    public static function cancelarSaida(Pedido $pedido): void
    {
        MovimentacaoEstoque::query()
            ->where('pedido_id', $pedido->id)
            ->each(fn (MovimentacaoEstoque $movimentacao) => $movimentacao->delete());
    }

    protected static function montarObservacao(Pedido $pedido): string
    {
        return sprintf(
            'Saída automática — Pedido #%s — Cliente: %s — Produto: %s',
            $pedido->id,
            $pedido->cliente?->nome ?? 'Não informado',
            $pedido->produto?->nome ?? 'Não informado',
        );
    }
}
