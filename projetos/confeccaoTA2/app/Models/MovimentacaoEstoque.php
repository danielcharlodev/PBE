<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimentacaoEstoque extends Model
{
    protected $table = 'movimentacoes_estoque';

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'tipo',
        'quantidade',
        'observacao',
    ];

    protected static function booted(): void
    {
        static::created(function (MovimentacaoEstoque $movimentacao): void {
            $movimentacao->aplicarNoEstoque();
        });

        static::updated(function (MovimentacaoEstoque $movimentacao): void {
            if (! $movimentacao->wasChanged(['produto_id', 'tipo', 'quantidade'])) {
                return;
            }

            $original = new self([
                'produto_id' => $movimentacao->getOriginal('produto_id'),
                'tipo' => $movimentacao->getOriginal('tipo'),
                'quantidade' => $movimentacao->getOriginal('quantidade'),
            ]);

            $original->setRelation('produto', Produto::query()->find($movimentacao->getOriginal('produto_id')));
            $original->reverterNoEstoque();

            $movimentacao->aplicarNoEstoque();
        });

        static::deleted(function (MovimentacaoEstoque $movimentacao): void {
            $movimentacao->reverterNoEstoque();
        });
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    public function aplicarNoEstoque(): void
    {
        $produto = $this->produto;

        if (! $produto) {
            return;
        }

        if ($this->tipo === 'entrada') {
            $produto->estoque += $this->quantidade;
        } else {
            $produto->estoque -= $this->quantidade;
        }

        $produto->save();
    }

    public function reverterNoEstoque(): void
    {
        $produto = $this->produto;

        if (! $produto) {
            return;
        }

        if ($this->tipo === 'entrada') {
            $produto->estoque -= $this->quantidade;
        } else {
            $produto->estoque += $this->quantidade;
        }

        $produto->save();
    }
}
