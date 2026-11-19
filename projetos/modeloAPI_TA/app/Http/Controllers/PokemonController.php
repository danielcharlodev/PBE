<?php

namespace App\Http\Controllers; // Namespace dos controllers (camada que recebe requisições e retorna respostas)

use Illuminate\Http\Request; // Representa a requisição HTTP (inputs, query params, arquivos, etc.)
use Illuminate\Support\Facades\Http; // Cliente HTTP do Laravel (para chamar APIs externas)
use Illuminate\Support\Facades\File; // Utilitário para operações de arquivo/pasta no sistema
use Illuminate\Support\Facades\Storage; // Abstração de armazenamento (local, s3, etc.)
use Illuminate\Support\Str; // Helpers de string (ex.: gerar UUID)
use App\Models\Pokemon; // Model Eloquent para a tabela "pokemons"

class PokemonController extends Controller
{
    public function index(Request $request) { // Página principal: lista locais e busca/sorteia um Pokémon (local ou da API)
        $localPokemons = Pokemon::latest()->take(50)->get(); // Busca os 50 pokémons locais mais recentes no banco

        $query = $request->input('pokemon'); // Lê o campo "pokemon" enviado (por querystring ou form)
        $apiPokemon = null; // Vai guardar os dados do Pokémon para exibir na tela (local ou API)
        
        if ($query) { // Se o usuário digitou algo para buscar...
            // Primeiro tenta achar no banco local (mais rápido e inclui pokémons cadastrados pelo sistema).
            $local = Pokemon::where('nome', 'like', "%{$query}%") // Procura por nome parecido
                           ->orWhere('tipo', 'like', "%{$query}%") // ...ou por tipo parecido
                           ->first(); // Pega o primeiro resultado
            if ($local) { // Se achou um Pokémon local...
                $apiPokemon = [ // Monta um “formato parecido” com o da PokeAPI para reaproveitar a view
                    'id' => $local->id, // Id do registro local
                    'name' => strtolower($local->nome), // Nome em minúsculo (padrão da API)
                    'types' => [['type' => ['name' => $local->tipo]]], // Tipos no formato da API
                    'height' => 10, // Altura fake (não armazenada no banco)
                    'weight' => 100, // Peso fake (não armazenado no banco)
                    'sprites' => ['front_default' => $local->foto ? Storage::url($local->foto) : 'https://via.placeholder.com/160?text=?'], // Imagem: foto local ou placeholder
                    'stats' => [ // Status no formato da API
                        ['base_stat' => $local->poder, 'stat' => ['name' => 'power']] // Usa "poder" como stat
                    ], // Fim stats
                    'abilities' => [['ability' => ['name' => $local->tipo]]], // “Habilidade” fake usando o tipo
                    'isLocal' => true, // Flag para a view saber que veio do banco
                    'descricao' => $local->descricao // Descrição salva localmente
                ]; // Fim do array do Pokémon local
            } else { // Se não achou localmente...
                // Senão tenta buscar na PokeAPI pelo nome/id informado.
                $nomeOuId = strtolower($query); // Normaliza para minúsculo (a API aceita nomes em minúsculo)
                $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$nomeOuId}"); // Chama a PokeAPI
                if ($response->successful()) { // Se a API respondeu 200/ok...
                    $apiPokemon = $response->json(); // Pega o JSON retornado pela API
                } // Fim do if successful
            } // Fim do else (API)
        } else { // Se não veio busca do usuário...
            // Sorteio: 30% chance de mostrar um local e 70% chance de mostrar um da PokeAPI.
            if (rand(1,10) <= 3) { // Gera número 1..10 e considera 1..3 como “local” (~30%)
                $local = Pokemon::inRandomOrder()->first(); // Pega um Pokémon local aleatório
                if ($local) { // Se existir pelo menos 1 Pokémon no banco...
                    $apiPokemon = [ // Monta no formato parecido com o da PokeAPI (igual acima)
                        'id' => $local->id, // Id do registro local
                        'name' => strtolower($local->nome), // Nome em minúsculo
                        'types' => [['type' => ['name' => $local->tipo]]], // Tipos no formato da API
                        'height' => 10, // Altura fake
                        'weight' => 100, // Peso fake
                        'sprites' => ['front_default' => $local->foto ? Storage::url($local->foto) : 'https://via.placeholder.com/160?text=?'], // URL da imagem ou placeholder
                        'stats' => [ // Status no formato da API
                            ['base_stat' => $local->poder, 'stat' => ['name' => 'power']] // Usa "poder" como stat
                        ], // Fim stats
                        'abilities' => [['ability' => ['name' => $local->tipo]]], // “Habilidade” fake usando o tipo
                        'isLocal' => true, // Marca como origem local
                        'descricao' => $local->descricao // Descrição local
                    ]; // Fim array local sorteado
                } // Fim if local existe
            } else { // Caso contrário, sorteia da API...
                $randomId = rand(1,898); // Sorteia um id válido aproximado da PokeAPI (1..898)
                $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$randomId}"); // Busca na PokeAPI
                if ($response->successful()) { // Se deu certo...
                    $apiPokemon = $response->json(); // Usa o JSON retornado
                } // Fim if successful
            } // Fim else (API)
        } // Fim do if/else (query vs sorteio)

        return view('pokemon', [ // Renderiza a view "pokemon" (Blade)
            'localPokemons' => $localPokemons, // Lista de pokémons cadastrados no banco para exibir na página
            'apiPokemon' => $apiPokemon // Pokémon selecionado (local ou API) para exibir detalhes
        ]); // Fim do retorno da view
    }

    public function store(Request $request)
    {
        $validated = $request->validate([ // Valida os dados do formulário (se falhar, retorna erro automaticamente)
            'name' => 'required|string|max:100', // Nome obrigatório, texto, até 100
            'type' => 'required|string|max:50', // Tipo obrigatório, texto, até 50
            'power' => 'required|string|max:50', // Poder obrigatório, texto, até 50
            'description' => 'required|string', // Descrição obrigatória
            'attacks_json' => 'nullable|string|max:20000', // JSON de ataques (opcional), texto grande
            'photo' => 'nullable|image|max:2048', // Foto opcional, tem que ser imagem, até 2MB
        ]); // Fim da validação

        $data = [ // Mapeia os campos do request para os nomes usados no banco
            'nome' => $validated['name'], // Campo "nome" no banco vem de "name" do formulário
            'tipo' => $validated['type'], // Campo "tipo"
            'poder' => $validated['power'], // Campo "poder"
            'descricao' => $validated['description'], // Campo "descricao"
            'ataques' => $this->parseAttacks($validated['attacks_json'] ?? null), // Converte o JSON de ataques em array limpo
        ]; // Fim do array $data

        if ($request->hasFile('photo')) { // Se o usuário enviou uma foto...
            $directory = public_path('uploads/pokemons'); // Define a pasta pública onde as imagens serão salvas
            if (!File::exists($directory)) { // Se a pasta não existir ainda...
                File::makeDirectory($directory, 0755, true); // ...cria a pasta (com recursão) e permissões 0755
            } // Fim do if de criar pasta

            $file = $request->file('photo'); // Obtém o arquivo enviado
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension(); // Gera um nome único e preserva a extensão
            $file->move($directory, $filename); // Move o arquivo para a pasta pública
            $path = 'uploads/pokemons/' . $filename; // Monta o caminho relativo para servir via web
            $data['foto'] = $path; // Salva o caminho da foto no campo "foto"
        } // Fim do upload de foto

        $pokemon = Pokemon::create($data); // Cria o registro do Pokémon no banco (mass assignment)

        return response()->json([ // Retorna JSON para o frontend (AJAX)
            'success' => true, // Marca operação como sucesso
            'pokemon' => $this->formatLocalPokemon($pokemon), // Retorna o Pokémon no formato “API-like”
        ]); // Fim da resposta JSON
    }

    public function search(Request $request)
    {
        $query = trim((string) $request->query('q', '')); // Lê o parâmetro ?q=... e remove espaços

        if ($query === '') { // Se o usuário não informou nada...
            return response()->json([ // Retorna erro de validação
                'message' => 'Informe um nome ou id para pesquisar.', // Mensagem simples para o usuário
            ], 422); // HTTP 422 = dados inválidos
        } // Fim do if query vazia

        $localQuery = Pokemon::query(); // Inicia uma query Eloquent para procurar no banco local

        if (is_numeric($query)) { // Se o termo parece ser número...
            $localQuery->where('id', (int) $query); // ...tenta buscar por id exato
        } else { // Se for texto...
            $localQuery->where('nome', 'like', "%{$query}%") // ...procura por nome parecido
                ->orWhere('tipo', 'like', "%{$query}%"); // ...ou por tipo parecido
        } // Fim do if/else (numérico vs texto)

        $localPokemon = $localQuery->first(); // Pega o primeiro resultado encontrado no banco

        if ($localPokemon) { // Se achou localmente...
            return response()->json([ // Retorna no formato esperado pelo frontend
                'success' => true, // Ok
                'pokemon' => $this->formatLocalPokemon($localPokemon), // Formata para parecer com a PokeAPI
                'source' => 'local', // Diz a origem dos dados
            ]); // Fim do retorno local
        } // Fim do if local encontrado

        $response = Http::get('https://pokeapi.co/api/v2/pokemon/' . strtolower($query)); // Se não achou local, tenta na PokeAPI

        if ($response->successful()) { // Se a PokeAPI respondeu com sucesso...
            return response()->json([ // Retorna a resposta da API
                'success' => true, // Ok
                'pokemon' => $response->json(), // JSON da PokeAPI
                'source' => 'api', // Origem API
            ]); // Fim do retorno API
        } // Fim do if successful

        return response()->json([ // Se não achou em lugar nenhum...
            'success' => false, // Marca como falha
            'message' => "Pokémon \"{$query}\" não encontrado.", // Mensagem de “não encontrado”
        ], 404); // HTTP 404 = não encontrado
    }

    private function formatLocalPokemon(Pokemon $local): array
    {
        $imageUrl = $this->resolveImageUrl($local->foto); // Resolve a URL final da imagem (considerando formatos diferentes)
        $storedAttacks = $local->ataques; // Pega ataques do model (pode vir como array ou string dependendo do cast/DB)
        if (is_string($storedAttacks) && $storedAttacks !== '') { // Se por algum motivo vier como JSON em string...
            $decoded = json_decode($storedAttacks, true); // Decodifica para array
            $storedAttacks = is_array($decoded) ? $decoded : []; // Se não virar array, usa vazio
        } // Fim do ajuste para ataques em string

        $customAttacks = collect($storedAttacks ?? []) // Cria uma Collection para transformar/normalizar os ataques
            ->map(function ($attack): array { // Mapeia cada item para o formato esperado
                return [ // Retorna um ataque normalizado
                    'name' => (string) ($attack['name'] ?? 'Ataque'), // Nome do ataque (com fallback)
                    'damage' => (string) ($attack['damage'] ?? ''), // Dano do ataque (texto)
                    'description' => (string) ($attack['description'] ?? ''), // Descrição do ataque (texto)
                ]; // Fim do ataque normalizado
            }) // Fim do map
            ->values() // Reindexa o array (0..n)
            ->all(); // Converte a Collection para array puro

        return [ // Retorna um array no “formato PokeAPI” (para o frontend tratar igual)
            'id' => $local->id, // Id do Pokémon local
            'name' => strtolower($local->nome), // Nome em minúsculo
            'types' => [['type' => ['name' => strtolower($local->tipo)]]], // Tipo no formato da API
            'height' => 10, // Altura fake
            'weight' => 100, // Peso fake
            'sprites' => [ // Estrutura de imagens no formato parecido com PokeAPI
                'front_default' => $imageUrl, // Imagem principal
                'other' => [ // Sub-estrutura usada por algumas telas
                    'official-artwork' => [ // Chave parecida com a da PokeAPI
                        'front_default' => $imageUrl, // Reusa a mesma imagem como “oficial”
                    ], // Fim official-artwork
                ], // Fim other
            ], // Fim sprites
            'stats' => [ // Status no formato da API
                ['base_stat' => 80, 'stat' => ['name' => 'hp']], // HP fake
                ['base_stat' => (int) $local->poder, 'stat' => ['name' => 'attack']], // Attack usando o poder local
                ['base_stat' => 70, 'stat' => ['name' => 'defense']], // Defense fake
            ], // Fim stats
            'abilities' => [ // Habilidades no formato da API
                ['ability' => ['name' => 'custom-local'], 'is_hidden' => false], // Marca como habilidade “local”
            ], // Fim abilities
            'isLocal' => true, // Flag de origem local
            'descricao' => $local->descricao, // Descrição local
            'custom_attacks' => $customAttacks, // Ataques customizados (do banco)
        ]; // Fim do retorno
    }

    private function parseAttacks(?string $raw): array
    {
        if (!$raw) { // Se não veio nada...
            return []; // ...não há ataques
        } // Fim do if raw vazio

        $decoded = json_decode($raw, true); // Tenta converter JSON em array PHP
        if (!is_array($decoded)) { // Se não for um array válido...
            return []; // ...retorna vazio
        } // Fim do if decoded inválido

        return collect($decoded) // Usa Collection para limpar/normalizar
            ->filter(fn ($attack): bool => is_array($attack)) // Mantém só itens que são arrays
            ->map(function (array $attack): array { // Normaliza cada ataque
                $name = trim((string) ($attack['name'] ?? '')); // Nome (sem espaços nas bordas)
                $description = trim((string) ($attack['description'] ?? '')); // Descrição (trim)
                $damage = trim((string) ($attack['damage'] ?? '')); // Dano (trim)

                return [ // Retorna o ataque já no formato final
                    'name' => $name !== '' ? $name : 'Ataque', // Se não veio nome, usa "Ataque"
                    'damage' => $damage, // Dano (pode ficar vazio)
                    'description' => $description !== '' ? $description : 'Sem descrição', // Se não veio descrição, usa fallback
                ]; // Fim do ataque
            }) // Fim do map
            ->filter(fn (array $attack): bool => $attack['name'] !== '' || $attack['description'] !== '' || $attack['damage'] !== '') // Remove ataques totalmente vazios
            ->values() // Reindexa
            ->all(); // Converte para array
    }

    private function resolveImageUrl(?string $path): string
    {
        if (!$path) { // Se não existe caminho de imagem...
            return 'https://via.placeholder.com/160?text=?'; // ...retorna um placeholder
        } // Fim do if sem path

        if (str_starts_with($path, 'uploads/')) { // Se a foto foi salva em public/uploads...
            return '/' . ltrim($path, '/'); // ...retorna uma URL relativa direta (servida pelo webserver)
        } // Fim do if uploads

        if (str_starts_with($path, 'pokemons/')) { // Se estiver no disco "public" do Storage (padrão /storage)...
            return '/storage/' . ltrim($path, '/'); // ...prefixa com /storage
        } // Fim do if pokemons/

        $url = Storage::url($path); // Pede ao Storage a URL correta para esse caminho
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) { // Se já for URL completa...
            return $url; // ...retorna direto
        } // Fim do if URL completa

        return '/' . ltrim($url, '/'); // Garante que começa com "/" para virar URL relativa válida
    }
}
