<?php

namespace App\Models; // Namespace onde ficam os models da aplicação

use Illuminate\Database\Eloquent\Model; // Base do Eloquent (ORM) para representar uma tabela do banco
use Illuminate\Support\Facades\DB; // Facade para fazer queries diretas no banco (Query Builder)

class Pokemon extends Model
{
    protected $table = 'pokemons'; // Define explicitamente o nome da tabela no banco
    
    protected $fillable = [ // Lista de campos que podem ser preenchidos em massa (ex.: Pokemon::create)
        'nome', // Nome do Pokémon
        'tipo',  // Tipo do Pokémon (ex.: fogo, água)
        'poder', // Poder/força (salvo como string no banco)
        'descricao', // Texto descritivo do Pokémon
        'foto', // Caminho/URL da imagem salva
        'ataques', // Lista/JSON de ataques customizados
    ]; // Fim dos campos "fillable"

    protected $casts = [ // Converte campos automaticamente quando lê/escreve no model
        'ataques' => 'array', // Faz o Laravel tratar "ataques" como array (serializa/deserializa JSON)
    ]; // Fim dos casts

    protected static function booted(): void // Hook chamado quando o model é “bootado” (inicializado pelo Eloquent)
    {
        static::creating(function (Pokemon $pokemon): void { // Roda antes de criar um novo registro no banco
            if (!empty($pokemon->id)) { // Se o id já foi definido manualmente...
                return; // ...não altera (respeita o id existente)
            } // Fim do if do id já preenchido

            $nextId = ((int) DB::table('pokemons')->max('id')) + 1; // Pega o maior id atual e soma 1 (próximo id)
            $pokemon->id = max(1026, $nextId); // Garante que ids locais comecem em 1026+ (evita “bater” com ids da API)
        }); // Fim do evento creating
    }
}
