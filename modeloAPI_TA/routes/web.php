<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\PokemonController;

Route::get('/pokedex', [PokemonController::class, 'index']);

Route::get('/', function () {
    return view('pokemon');
});

// Exemplo de get
Route::get('/pokemon/{nome}', function ($nome) {
    $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$nome}");

    if ($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status' => 'Conectado com Sucesso!',
            'resultado' => [
                'indentificador' => $dados['id'],
                'nome_do_pokemon' => ucfirst($dados['name']),
                'foto' => $dados['sprites']['front_default']
            ]
        ], 200);
    } else {
        return response()->json([
            'erro' => 'Pokémon não encontrado'
        ], 404);
    }
});

// Exemplo de Post
Route::post('/pokemon/novo', function (Request $request) {
    $dados = $request->validate([
        'nome' => 'required|string|min:3',
        'tipo' => 'required|string',
        'ataque' => 'required|integer'
    ]);

    return response()->json([
            'mensagem' => 'Pokemon cadastrado com sucesso!',
            'id_gerado' => rand(1000,9999),
            'dados_recebidos' => $dados
        ], 201
    );
});

// Exemplo de Post
Route::post('/usuario/novo', function (Request $request) {

    $dados = $request->validate([
        'nome' => 'required|string|min:3',
        'sobrenome' => 'required|string|min:3',
        'email' => 'required|email',

        'idade' => 'nullable|integer',
        'genero' => 'nullable|string',
        'telefone' => 'nullable|string',
        'usuario' => 'nullable|string',
        'senha' => 'nullable|string',
        'data_nascimento' => 'nullable|string',

        'altura' => 'nullable|integer',
        'peso' => 'nullable|integer',
        'cor_olho' => 'nullable|string',

        'cidade' => 'nullable|string',
        'estado' => 'nullable|string',
        'pais' => 'nullable|string'
    ]);

    $response = Http::post("https://dummyjson.com/users/add", [

        'firstName' => $dados['nome'],
        'lastName' => $dados['sobrenome'],
        'email' => $dados['email'],

        'age' => $dados['idade'] ?? null,
        'gender' => $dados['genero'] ?? null,
        'phone' => $dados['telefone'] ?? null,
        'username' => $dados['usuario'] ?? null,
        'password' => $dados['senha'] ?? null,
        'birthDate' => $dados['data_nascimento'] ?? null,

        'height' => $dados['altura'] ?? null,
        'weight' => $dados['peso'] ?? null,
        'eyeColor' => $dados['cor_olho'] ?? null,

        'address' => [
            'city' => $dados['cidade'] ?? null,
            'state' => $dados['estado'] ?? null,
            'country' => $dados['pais'] ?? null
        ]
    ]);

    return response()->json([
        'mensagem' => 'Usuário cadastrado com sucesso!',
        'retorno_api' => $response->json()
    ], 201);
});

Route::get('/usuario/{id}', function ($id) {
    $response = Http::get("https://dummyjson.com/users/{$id}");

    if ($response->successful()) {
        $dados = $response->json();

        return response()->json([
            'status' => 'Conectado com sucesso!',
            'resultado' => [
                'id' => $dados['id'],
                'nome' => $dados['firstName'] . ' ' . $dados['lastName'],
                'email' => $dados['email'],
                'foto' => $dados['image']
            ]
        ], 200);

    } else {
        return response()->json([
            'erro' => 'Usuário não encontrado'
        ], 404);
    }
});




















// Route::get('/', function () {
//     return view('welcome');
// });