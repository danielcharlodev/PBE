<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Pokémon</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .card-wrapper {
            perspective: 1000px;
        }

        .pokemon-card {
            width: 320px;
            height: 450px;
            border-radius: 18px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.1s ease-out;
            cursor: pointer;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.4),
                0 0 60px rgba(255, 215, 0, 0.1);
        }

        .pokemon-card:hover {
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.5),
                0 0 80px rgba(255, 215, 0, 0.2);
        }

        .card-inner {
            width: 100%;
            height: 100%;
            border-radius: 18px;
            padding: 12px;
            position: relative;
            overflow: hidden;
        }

        /* Tipos de Pokémon */
        .type-fire { background: linear-gradient(145deg, #ff6b35, #f7931e, #ffcc00); }
        .type-water { background: linear-gradient(145deg, #3b82f6, #06b6d4, #22d3ee); }
        .type-grass { background: linear-gradient(145deg, #22c55e, #84cc16, #a3e635); }
        .type-electric { background: linear-gradient(145deg, #facc15, #fbbf24, #fcd34d); }
        .type-psychic { background: linear-gradient(145deg, #ec4899, #f472b6, #f9a8d4); }
        .type-ice { background: linear-gradient(145deg, #67e8f9, #a5f3fc, #cffafe); }
        .type-dragon { background: linear-gradient(145deg, #7c3aed, #8b5cf6, #a78bfa); }
        .type-dark { background: linear-gradient(145deg, #374151, #4b5563, #6b7280); }
        .type-fairy { background: linear-gradient(145deg, #f9a8d4, #fbcfe8, #fce7f3); }
        .type-fighting { background: linear-gradient(145deg, #dc2626, #ef4444, #f87171); }
        .type-flying { background: linear-gradient(145deg, #a78bfa, #c4b5fd, #ddd6fe); }
        .type-poison { background: linear-gradient(145deg, #a855f7, #c084fc, #d8b4fe); }
        .type-ground { background: linear-gradient(145deg, #d97706, #f59e0b, #fbbf24); }
        .type-rock { background: linear-gradient(145deg, #78716c, #a8a29e, #d6d3d1); }
        .type-bug { background: linear-gradient(145deg, #65a30d, #84cc16, #a3e635); }
        .type-ghost { background: linear-gradient(145deg, #6366f1, #818cf8, #a5b4fc); }
        .type-steel { background: linear-gradient(145deg, #9ca3af, #d1d5db, #e5e7eb); }
        .type-normal { background: linear-gradient(145deg, #a8a29e, #d6d3d1, #e7e5e4); }

        /* Efeito Holográfico */
        .holo-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                125deg,
                transparent 0%,
                rgba(255, 255, 255, 0.1) 25%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0.1) 75%,
                transparent 100%
            );
            background-size: 400% 100%;
            animation: shimmer 3s infinite linear;
            pointer-events: none;
            border-radius: 18px;
        }

        .rainbow-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                45deg,
                rgba(255, 0, 0, 0.1),
                rgba(255, 127, 0, 0.1),
                rgba(255, 255, 0, 0.1),
                rgba(0, 255, 0, 0.1),
                rgba(0, 0, 255, 0.1),
                rgba(75, 0, 130, 0.1),
                rgba(143, 0, 255, 0.1)
            );
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
            border-radius: 18px;
            mix-blend-mode: overlay;
        }

        .pokemon-card:hover .rainbow-overlay {
            opacity: 1;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        /* Conteúdo do Card */
        .card-content {
            background: #fffef5;
            border-radius: 12px;
            height: 100%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 3px solid rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .pokemon-stage {
            font-size: 10px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
        }

        .pokemon-name-row {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pokemon-name {
            font-size: 18px;
            font-weight: 800;
            color: #1a1a1a;
            text-transform: capitalize;
        }

        .ex-badge {
            background: linear-gradient(135deg, #ffd700, #ffaa00);
            color: #000;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: lowercase;
            font-style: italic;
        }

        .pokemon-hp {
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .hp-value {
            font-size: 22px;
            font-weight: 800;
            color: #dc2626;
        }

        .hp-label {
            font-size: 10px;
            font-weight: 600;
            color: #dc2626;
        }

        .type-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-left: 4px;
        }

        /* Imagem do Pokémon */
        .pokemon-image-container {
            background: linear-gradient(180deg, #e8e8e8 0%, #d0d0d0 100%);
            border-radius: 8px;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 6px;
            position: relative;
            overflow: hidden;
            border: 4px solid #c9b45c;
        }

        .pokemon-image {
            width: 120px;
            height: 120px;
            object-fit: contain;
            filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.3));
            transition: transform 0.3s;
        }

        .pokemon-card:hover .pokemon-image {
            transform: scale(1.05);
        }

        .pokemon-info-bar {
            display: flex;
            justify-content: space-between;
            font-size: 8px;
            color: #666;
            padding: 2px 4px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            margin-bottom: 8px;
        }

        /* Ataques */
        .attacks {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .attack {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 6px;
            background: rgba(0, 0, 0, 0.02);
            border-radius: 6px;
        }

        .attack-cost {
            display: flex;
            gap: 2px;
            min-width: 40px;
        }

        .energy {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        .energy-fire { background: radial-gradient(circle at 30% 30%, #ff6b35, #dc2626); }
        .energy-water { background: radial-gradient(circle at 30% 30%, #60a5fa, #2563eb); }
        .energy-grass { background: radial-gradient(circle at 30% 30%, #4ade80, #16a34a); }
        .energy-electric { background: radial-gradient(circle at 30% 30%, #fde047, #eab308); }
        .energy-psychic { background: radial-gradient(circle at 30% 30%, #f472b6, #db2777); }
        .energy-fighting { background: radial-gradient(circle at 30% 30%, #f87171, #dc2626); }
        .energy-colorless { background: radial-gradient(circle at 30% 30%, #e5e5e5, #a3a3a3); }
        .energy-dark { background: radial-gradient(circle at 30% 30%, #6b7280, #374151); }
        .energy-dragon { background: radial-gradient(circle at 30% 30%, #a78bfa, #7c3aed); }
        .energy-fairy { background: radial-gradient(circle at 30% 30%, #f9a8d4, #ec4899); }
        .energy-steel { background: radial-gradient(circle at 30% 30%, #d1d5db, #9ca3af); }

        .attack-info {
            flex: 1;
        }

        .attack-name {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .attack-description {
            font-size: 9px;
            color: #666;
            line-height: 1.3;
        }

        .attack-damage {
            font-size: 20px;
            font-weight: 800;
            color: #1a1a1a;
            min-width: 40px;
            text-align: right;
        }

        /* Regra ex */
        .ex-rule {
            font-size: 8px;
            color: #666;
            font-style: italic;
            padding: 4px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 4px;
        }

        /* Footer do Card */
        .card-footer {
            display: flex;
            justify-content: space-between;
            padding-top: 6px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            font-size: 10px;
        }

        .stat-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .stat-label {
            font-size: 8px;
            color: #888;
            text-transform: uppercase;
        }

        .stat-value {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .weakness-icon, .resistance-icon {
            width: 14px;
            height: 14px;
            border-radius: 50%;
        }

        .retreat-cost {
            display: flex;
            gap: 2px;
        }

        .retreat-energy {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, #e5e5e5, #a3a3a3);
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        /* Botões */
        .buttons {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5);
        }

        .btn-favorite {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .btn-favorite:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-favorite.active {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-color: transparent;
        }

        .btn-favorite.active .heart {
            color: white;
        }

        .heart {
            font-size: 18px;
            transition: transform 0.2s;
        }

        .btn-favorite:hover .heart {
            transform: scale(1.2);
        }

        .loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #666;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e5e7eb;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .pokemon-id {
            position: absolute;
            bottom: 4px;
            right: 8px;
            font-size: 8px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card-wrapper">
            <div class="pokemon-card" id="pokemonCard">
                <div class="card-inner type-fire" id="cardInner">
                    <div class="holo-effect"></div>
                    <div class="rainbow-overlay"></div>
                    <div class="card-content" id="cardContent">
                        <div class="loading" id="loading">
                            <div class="spinner"></div>
                            <p style="margin-top: 12px;">Carregando Pokémon...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="buttons">
            <button class="btn btn-primary" id="newPokemonBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M23 4v6h-6M1 20v-6h6M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15"/>
                </svg>
                Novo Pokémon
            </button>
            <button class="btn btn-favorite" id="favoriteBtn">
                <span class="heart">&#9825;</span>
                Favoritar
            </button>
        </div>
    </div>

    <script>
        const typeColors = {
            fire: 'type-fire',
            water: 'type-water',
            grass: 'type-grass',
            electric: 'type-electric',
            psychic: 'type-psychic',
            ice: 'type-ice',
            dragon: 'type-dragon',
            dark: 'type-dark',
            fairy: 'type-fairy',
            fighting: 'type-fighting',
            flying: 'type-flying',
            poison: 'type-poison',
            ground: 'type-ground',
            rock: 'type-rock',
            bug: 'type-bug',
            ghost: 'type-ghost',
            steel: 'type-steel',
            normal: 'type-normal'
        };

        const typeWeaknesses = {
            fire: 'water',
            water: 'electric',
            grass: 'fire',
            electric: 'ground',
            psychic: 'dark',
            ice: 'fire',
            dragon: 'dragon',
            dark: 'fighting',
            fairy: 'steel',
            fighting: 'psychic',
            flying: 'electric',
            poison: 'ground',
            ground: 'water',
            rock: 'water',
            bug: 'fire',
            ghost: 'dark',
            steel: 'fire',
            normal: 'fighting'
        };

        let currentPokemon = null;
        let favorites = JSON.parse(localStorage.getItem('pokemonFavorites') || '[]');

        // Efeito 3D Tilt
        const card = document.getElementById('pokemonCard');
        
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'rotateX(0) rotateY(0)';
        });

        // Buscar Pokémon
        async function fetchPokemon() {
            const loading = document.getElementById('loading');
            const cardContent = document.getElementById('cardContent');
            
            loading.style.display = 'flex';
            
            try {
                const randomId = Math.floor(Math.random() * 898) + 1;
                const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${randomId}`);
                const data = await response.json();
                
                currentPokemon = data;
                renderCard(data);
                updateFavoriteButton();
            } catch (error) {
                console.error('Erro ao buscar Pokémon:', error);
                cardContent.innerHTML = '<div class="loading"><p>Erro ao carregar. Tente novamente.</p></div>';
            }
        }

        function renderCard(pokemon) {
            const cardInner = document.getElementById('cardInner');
            const cardContent = document.getElementById('cardContent');
            const type = pokemon.types[0].type.name;
            
            // Atualizar cor do card
            cardInner.className = `card-inner ${typeColors[type] || 'type-normal'}`;
            
            const hp = pokemon.stats.find(s => s.stat.name === 'hp').base_stat;
            const attack = pokemon.stats.find(s => s.stat.name === 'attack').base_stat;
            const defense = pokemon.stats.find(s => s.stat.name === 'defense').base_stat;
            const weakness = typeWeaknesses[type] || 'fighting';
            
            const attackDamage1 = Math.floor(attack * 0.5) + 10;
            const attackDamage2 = Math.floor(attack * 1.2) + 30;
            
            cardContent.innerHTML = `
                <div class="card-header">
                    <div>
                        <div class="pokemon-stage">Básico</div>
                        <div class="pokemon-name-row">
                            <span class="pokemon-name">${pokemon.name}</span>
                            <span class="ex-badge">ex</span>
                        </div>
                    </div>
                    <div class="pokemon-hp">
                        <span class="hp-label">PS</span>
                        <span class="hp-value">${hp + 100}</span>
                        <div class="type-icon energy-${type}" title="${type}"></div>
                    </div>
                </div>
                
                <div class="pokemon-image-container">
                    <img 
                        src="${pokemon.sprites.other['official-artwork'].front_default || pokemon.sprites.front_default}" 
                        alt="${pokemon.name}"
                        class="pokemon-image"
                    />
                </div>
                
                <div class="pokemon-info-bar">
                    <span>NO. ${String(pokemon.id).padStart(4, '0')}</span>
                    <span>${pokemon.types.map(t => t.type.name).join(' / ')}</span>
                    <span>Altura: ${pokemon.height / 10}m | Peso: ${pokemon.weight / 10}kg</span>
                </div>
                
                <div class="attacks">
                    <div class="attack">
                        <div class="attack-cost">
                            <div class="energy energy-${type}"></div>
                        </div>
                        <div class="attack-info">
                            <div class="attack-name">Investida Rápida</div>
                            <div class="attack-description">Jogue uma moeda. Se der coroa, este ataque causa 10 de dano a mais.</div>
                        </div>
                        <div class="attack-damage">${attackDamage1}</div>
                    </div>
                    
                    <div class="attack">
                        <div class="attack-cost">
                            <div class="energy energy-${type}"></div>
                            <div class="energy energy-${type}"></div>
                            <div class="energy energy-colorless"></div>
                        </div>
                        <div class="attack-info">
                            <div class="attack-name">Impacto Devastador</div>
                            <div class="attack-description">Este Pokémon também causa ${Math.floor(attackDamage2 * 0.2)} de dano a si mesmo.</div>
                        </div>
                        <div class="attack-damage">${attackDamage2}</div>
                    </div>
                </div>
                
                <div class="ex-rule">
                    <strong>Regra de Pokémon ex:</strong> Quando seu Pokémon ex for Nocauteado, seu oponente pega 2 cartas de Prêmio.
                </div>
                
                <div class="card-footer">
                    <div class="stat-group">
                        <span class="stat-label">Fraqueza</span>
                        <div class="stat-value">
                            <div class="weakness-icon energy-${weakness}"></div>
                            <span>×2</span>
                        </div>
                    </div>
                    
                    <div class="stat-group">
                        <span class="stat-label">Resistência</span>
                        <div class="stat-value">
                            <span>—</span>
                        </div>
                    </div>
                    
                    <div class="stat-group">
                        <span class="stat-label">Custo de Recuo</span>
                        <div class="retreat-cost">
                            ${Array(Math.min(Math.ceil(pokemon.weight / 500), 4)).fill('<div class="retreat-energy"></div>').join('')}
                        </div>
                    </div>
                </div>
                
                <div class="pokemon-id">Illus. Pokémon TCG</div>
            `;
        }

        function toggleFavorite() {
            if (!currentPokemon) return;
            
            const index = favorites.indexOf(currentPokemon.id);
            if (index === -1) {
                favorites.push(currentPokemon.id);
            } else {
                favorites.splice(index, 1);
            }
            
            localStorage.setItem('pokemonFavorites', JSON.stringify(favorites));
            updateFavoriteButton();
        }

        function updateFavoriteButton() {
            const btn = document.getElementById('favoriteBtn');
            const heart = btn.querySelector('.heart');
            
            if (currentPokemon && favorites.includes(currentPokemon.id)) {
                btn.classList.add('active');
                heart.innerHTML = '&#9829;';
            } else {
                btn.classList.remove('active');
                heart.innerHTML = '&#9825;';
            }
        }

        // Event Listeners
        document.getElementById('newPokemonBtn').addEventListener('click', fetchPokemon);
        document.getElementById('favoriteBtn').addEventListener('click', toggleFavorite);

        // Carregar Pokémon inicial
        fetchPokemon();
    </script>
</body>
</html>