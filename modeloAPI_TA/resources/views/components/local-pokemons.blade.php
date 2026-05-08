<div class="local-pokemons-section" style="width: 400px;">
    <h3 style="color: white; margin-bottom: 15px; font-size: 20px;">📱 Seus Pokémon ({{ count($localPokemons) }})</h3>
    <div class="local-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; max-height: 500px; overflow-y: auto;">
        @forelse($localPokemons as $pokemon)
            <div class="local-card" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); padding: 15px; border-radius: 12px; cursor: pointer; color: white; text-align: center; box-shadow: 0 4px 20px rgba(79,70,229,0.4); transition: transform 0.2s;">
                @if($pokemon->foto)
                    <img src="{{ Storage::url($pokemon->foto) }}" alt="{{ $pokemon->nome }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; margin-bottom: 10px; border: 3px solid white;">
                @else
                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; font-size: 30px;">?</div>
                @endif
                <h4 style="margin: 5px 0; font-size: 16px;">{{ ucfirst($pokemon->nome) }}</h4>
                <p style="font-size: 12px; opacity: 0.9; text-transform: capitalize;">{{ $pokemon->tipo }}</p>
                <p style="font-size: 11px; opacity: 0.8;">Poder: {{ $pokemon->poder }}</p>
            </div>
        @empty
            <p style="color: rgba(255,255,255,0.6); grid-column: 1/-1; text-align: center; padding: 30px;">Nenhum Pokémon cadastrado ainda! 🐣</p>
        @endforelse
    </div>
</div>

<style>
.local-card:hover {
    transform: translateY(-5px);
}
.local-grid::-webkit-scrollbar {
    width: 6px;
}
.local-grid::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.1);
}
.local-grid::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.3);
}
</style>
