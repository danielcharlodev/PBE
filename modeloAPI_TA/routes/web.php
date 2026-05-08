<?php

use Illuminate\Support\Facades\Route; // Facade para registrar rotas HTTP (GET/POST/etc.)
use App\Http\Controllers\PokemonController; // Controller que contém a lógica das páginas/ações de Pokémon

/*
|--------------------------------------------------------------------------
| Sistema Pokémon
|--------------------------------------------------------------------------
|
| Página principal
| Cadastro de Pokémon
| Exemplos de API
|
*/

Route::get('/', [PokemonController::class, 'index']); // GET / -> mostra a página principal/listagem (método index)

Route::post('/pokemons', [PokemonController::class, 'store']) // POST /pokemons -> cadastra/salva um Pokémon (método store)
    ->name('pokemons.store'); // Define um nome para a rota (útil para gerar URLs por nome)

Route::get('/pokemons/search', [PokemonController::class, 'search']) // GET /pokemons/search -> busca Pokémon por filtro/termo
    ->name('pokemons.search'); // Nome da rota de busca