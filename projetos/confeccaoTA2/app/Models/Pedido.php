<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pedido extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::saving(function (Pedido $pedido): void {
            if ($pedido->produto_id) {
                $pedido->valor_total = $pedido->calcularValorTotal();
            }
        });
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function movimentacaoEstoque(): HasOne
    {
        return $this->hasOne(MovimentacaoEstoque::class);
    }

    public function estoqueDisponivel(): int
    {
        if (! $this->produto_id) {
            return 0;
        }

        $produto = $this->relationLoaded('produto')
            ? $this->produto
            : Produto::query()->find($this->produto_id);

        if (! $produto) {
            return 0;
        }

        $disponivel = (int) $produto->estoque;

        if ($this->exists && $this->movimentacaoEstoque) {
            $disponivel += (int) $this->movimentacaoEstoque->quantidade;
        }

        return max(0, $disponivel);
    }

    public function calcularValorTotal(): float
    {
        if (! $this->produto_id) {
            return 0;
        }

        $preco = $this->relationLoaded('produto')
            ? $this->produto?->preco_venda
            : Produto::query()->whereKey($this->produto_id)->value('preco_venda');

        return (float) max(1, (int) $this->quantidade) * (float) ($preco ?? 0);
    }
}
