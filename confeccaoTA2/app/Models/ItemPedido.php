<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use App\Models\Pedido;

class ItemPedido extends Model
{
    // 🔓 Libera preenchimento em massa (todas as colunas)
    protected $guarded = [];

    // 🔗 RELACIONAMENTO: Item do pedido → Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    // 🔗 RELACIONAMENTO: Item do pedido → Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}