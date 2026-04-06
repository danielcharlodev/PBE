<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    // 🔓 Libera preenchimento em massa (todas as colunas)
    protected $guarded = [];

    // 🔗 RELACIONAMENTO: Pedido → Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // 🔗 RELACIONAMENTO: Pedido → Itens do pedido
    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}