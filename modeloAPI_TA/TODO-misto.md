# TODO - Integração Resultados Mistos (PokeAPI + Local)

**Plano aprovado: Resultados mistos na pesquisa**

## Information Gathered:
- Controller index(): busca só PokeAPI, passa `$pokemon` (view ignora, usa JS)
- View: JS fetch só PokeAPI (`https://pokeapi.co`), favoritos localStorage
- Model/DB: Pokémon locais salvos OK
- Sem listagem/busca local

## Plan:
1. **Controller index()**: 
   - Buscar locais `Pokemon::latest()->limit(10)->get()`
   - Buscar API
   - Passar `@json(['localPokemons' => $local, 'apiPokemon' => $api])`

2. **Routes**:
   - `GET /pokemons` list all local
   - `GET /pokemons/search?q={query}` busca local

3. **View**:
   - Nova section: Grid Pokémon locais (pequenos cards)
   - JS: fetch local + merge com API
   - Pesquisa: priorizar local, fallback API

## Files:
- PokemonController.php (index + indexLocal, search)
- routes/web.php (+ GET routes)
- resources/views/pokemon.blade.php (+ grid local + JS update)

## Followup:
- `php artisan route:cache` (optional)
- Test busca local + misto

**Confirma para implementar?**
