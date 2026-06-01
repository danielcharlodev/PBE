<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $guarded = []; // Libera preenchimento em lote com segurança tratada no form

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
