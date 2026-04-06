<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // 🔓 Libera preenchimento em massa (todas as colunas)
    protected $guarded = [];

    // 🔗 RELACIONAMENTO: Produto → Movimentações de estoque
    public function movimentacoes()
    {
        return $this->hasMany(MovimentacaoEstoque::class);
    }
}