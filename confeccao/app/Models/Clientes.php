<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clientes extends Model
{
    use HasFactory; // Agora o Laravel vai encontrar o que precisa

    protected $fillable = ['nome', 'cpf', 'telefone', 'reserva'];
}