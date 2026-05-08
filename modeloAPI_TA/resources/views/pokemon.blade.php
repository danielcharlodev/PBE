<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            width: 100%;
            max-width: 1400px;
        }

        .main-content {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            width: 100%;
            justify-content: center;
        }

        .card-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
        }

        .card-wrapper {
            perspective: 1000px;
        }

        .pokemon-card {
            width: 400px;
            height: 580px;
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
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 6px;
            position: relative;
            overflow: hidden;
            border: 4px solid #c9b45c;
        }

        .pokemon-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
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

        .card-tabs {
            display: flex;
            gap: 6px;
            margin-bottom: 8px;
        }

        .card-tab-btn {
            border: 1px solid #d1d5db;
            background: #f3f4f6;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .card-tab-btn.active {
            background: #1f2937;
            color: #fff;
            border-color: #1f2937;
        }

        .tab-content {
            flex: 1;
            overflow-y: auto;
        }

        .hidden {
            display: none !important;
        }

        .info-tab-panel {
            background: rgba(0, 0, 0, 0.03);
            border-radius: 8px;
            padding: 8px;
            display: grid;
            gap: 8px;
        }

        .info-block-title {
            font-size: 11px;
            font-weight: 700;
            color: #111827;
        }

        .info-block-text {
            font-size: 11px;
            line-height: 1.4;
            color: #374151;
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
            width: 400px;
            justify-content: space-between;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
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

        /* Campo de Pesquisa */
        .search-container {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 500px;
            justify-content: center;
        }

        .search-input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
        }

        .btn-search {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5);
        }

        /* Lista de Favoritos */
        .favorites-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 550px;
            height: fit-content;
        }

        .favorites-title {
            color: white;
            font-size: 18px;
            font-weight: 700;
            text-align: left;
        }

        .favorites-list {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            background: rgba(255, 255, 255, 0.05);
            padding: 12px;
            border-radius: 12px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            max-height: 200px;
            overflow-y: auto;
        }

        /* Scrollbar personalizado */
        .favorites-list::-webkit-scrollbar {
            width: 8px;
        }

        .favorites-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
        }

        .favorites-list::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 12px;
            transition: all 0.2s;
        }

        .favorites-list::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
        }

        /* Firefox */
        .favorites-list {
            scrollbar-color: #3b82f6 rgba(255, 255, 255, 0.05);
            scrollbar-width: thin;
        }

        .favorite-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding: 8px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .favorite-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .favorite-item img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        .favorite-item-name {
            font-size: 9px;
            color: white;
            font-weight: 600;
            text-align: center;
            text-transform: capitalize;
            line-height: 1.2;
        }

        .favorite-item-id {
            font-size: 7px;
            color: rgba(255, 255, 255, 0.7);
        }

        .remove-favorite {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 22px;
            height: 22px;
            background: rgba(255, 0, 0, 0.8);
            border: 2px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s;
            line-height: 1;
        }

        .favorite-item:hover .remove-favorite {
            opacity: 1;
        }

        .favorites-empty {
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            padding: 30px 15px;
            font-style: italic;
        }

        .btn-success {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
            box-shadow: 0 4px 15px rgba(22, 163, 74, 0.4);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 163, 74, 0.5);
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 999;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-card {
            width: 100%;
            max-width: 520px;
            background: #111827;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 18px;
            color: #f3f4f6;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .modal-form {
            display: grid;
            gap: 12px;
        }

        .modal-tab-buttons {
            display: flex;
            gap: 8px;
        }

        .modal-tab-btn {
            border: 1px solid #374151;
            background: #1f2937;
            color: #d1d5db;
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .modal-tab-btn.active {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        .modal-tab-content {
            display: grid;
            gap: 10px;
        }

        .attack-builder-row {
            display: grid;
            gap: 8px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            padding: 10px;
        }

        .attack-builder-title {
            font-size: 12px;
            font-weight: 700;
            color: #bfdbfe;
        }

        .modal-form label {
            font-size: 12px;
            font-weight: 600;
            color: #d1d5db;
        }

        .modal-form input,
        .modal-form textarea {
            width: 100%;
            margin-top: 6px;
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 8px;
            padding: 10px 12px;
            color: #f9fafb;
        }

        .modal-form textarea {
            min-height: 92px;
            resize: vertical;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 6px;
        }

        .modal-feedback {
            font-size: 12px;
            min-height: 18px;
        }

        .modal-feedback.error {
            color: #fca5a5;
        }

        .modal-feedback.success {
            color: #86efac;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="search-container">
            <input 
                type="text" 
                class="search-input" 
                id="searchInput" 
                placeholder="Nome ou número da Pokédex"
            />
            <button class="btn btn-search" id="searchBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                Pesquisar
            </button>
        </div>

        <div class="main-content">
            <div class="favorites-container">
                <div class="favorites-title">❤️ Seus Favoritos</div>
                <div class="favorites-list" id="favoritesList">
                    <div class="favorites-empty">Adicione Pokémons aos favoritos!</div>
                </div>
            </div>

            <div class="card-section">
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
                    <button class="btn btn-success" id="openCreateModalBtn">
                        Cadastrar Novo Pokémon
                    </button>
                    <button class="btn btn-favorite" id="favoriteBtn">
                        <span class="heart">&#9825;</span>
                        Favoritar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="createPokemonModal">
        <div class="modal-card">
            <div class="modal-title">Cadastrar Novo Pokémon</div>
            <form class="modal-form" id="createPokemonForm">
                <div class="modal-tab-buttons">
                    <button type="button" class="modal-tab-btn active" data-modal-tab="basic">Dados básicos</button>
                    <button type="button" class="modal-tab-btn" data-modal-tab="attacks">Ataques</button>
                </div>

                <div class="modal-tab-content" id="modal-tab-basic">
                    <label>Nome
                        <input type="text" name="name" required maxlength="100" />
                    </label>
                    <label>Tipo
                        <input type="text" name="type" required maxlength="50" />
                    </label>
                    <label>Poder
                        <input type="number" name="power" required min="1" />
                    </label>
                    <label>Descrição
                        <textarea name="description" required></textarea>
                    </label>
                    <label>Imagem local
                        <input type="file" name="photo" accept="image/*" />
                    </label>
                </div>

                <div class="modal-tab-content hidden" id="modal-tab-attacks">
                    <label>Quantidade de ataques
                        <input type="number" id="attackCountInput" min="1" max="6" value="1" />
                    </label>
                    <div id="attacksBuilder"></div>
                    <input type="hidden" name="attacks_json" id="attacksJsonInput" />
                </div>

                <div class="modal-feedback" id="createPokemonFeedback"></div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-favorite" id="closeCreateModalBtn">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="submitCreatePokemonBtn">Adicionar</button>
                </div>
            </form>
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
        async function fetchPokemon(searchQuery = null) {
            const cardContent = document.getElementById('cardContent');
            
            if (!cardContent) {
                console.error('cardContent não encontrado');
                return;
            }
            
            // Mostrar loading
            cardContent.innerHTML = '<div class="loading"><div class="spinner"></div><p style="margin-top: 12px;">Carregando Pokémon...</p></div>';
            
            try {
                let pokemon;
                
                if (searchQuery) {
                    const query = searchQuery.trim();
                    const response = await fetch(`/pokemons/search?q=${encodeURIComponent(query)}`);

                    if (!response.ok) {
                        const errorData = await response.json().catch(() => ({}));
                        throw new Error(errorData.message || `Pokémon "${searchQuery}" não encontrado`);
                    }

                    const data = await response.json();
                    pokemon = data.pokemon;
                } else {
                    // Buscar aleatório
                    const randomId = Math.floor(Math.random() * 898) + 1;
                    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${randomId}`);
                    pokemon = await response.json();
                }
                
                currentPokemon = pokemon;
                renderCard(pokemon);
                updateFavoriteButton();
            } catch (error) {
                console.error('Erro ao buscar Pokémon:', error);
                cardContent.innerHTML = `<div class="loading"><p style="color: #ff6b6b;">❌ ${error.message}</p></div>`;
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
            const weakness = typeWeaknesses[type] || 'fighting';

            const customAttacks = Array.isArray(pokemon.custom_attacks) ? pokemon.custom_attacks : [];
            const isLocalPokemon = Boolean(pokemon.isLocal || pokemon.descricao || pokemon.custom_attacks);
            const imageUrl =
                pokemon?.sprites?.other?.['official-artwork']?.front_default
                || pokemon?.sprites?.front_default
                || 'https://via.placeholder.com/160?text=?';

            const attacksHTML = customAttacks.length > 0
                ? customAttacks.map((move) => `
                    <div class="attack">
                        <div class="attack-cost">
                            <div class="energy energy-${type}"></div>
                        </div>
                        <div class="attack-info">
                            <div class="attack-name">${(move.name || 'Ataque').toUpperCase()}</div>
                            <div class="attack-description">${move.description || 'Ataque cadastrado manualmente.'}</div>
                        </div>
                        <div class="attack-damage">${move.damage || ''}</div>
                    </div>
                `).join('')
                : isLocalPokemon
                    ? `
                        <div class="attack">
                            <div class="attack-info">
                                <div class="attack-name">SEM ATAQUES CADASTRADOS</div>
                                <div class="attack-description">Cadastre ataques no modal para aparecerem aqui.</div>
                            </div>
                        </div>
                    `
                    : pokemon.abilities.map((ability) => `
                    <div class="attack">
                        <div class="attack-cost">
                            ${ability.is_hidden ? '<div style="font-size: 10px; color: #fbbf24; font-weight: 700;">H</div>' : '<div class="energy energy-' + type + '"></div>'}
                        </div>
                        <div class="attack-info">
                            <div class="attack-name">${ability.ability.name.replace('-', ' ').toUpperCase()}</div>
                            <div class="attack-description">${ability.is_hidden ? 'Habilidade Oculta' : 'Habilidade'}</div>
                        </div>
                    </div>
                `).slice(0, 3).join('');

            const pokemonDescription = pokemon.descricao || 'Sem descrição disponível para este Pokémon.';
            
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
                        src="${imageUrl}" 
                        alt="${pokemon.name}"
                        class="pokemon-image"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/160?text=?';"
                    />
                </div>
                
                <div class="pokemon-info-bar">
                    <span>NO. ${String(pokemon.id).padStart(4, '0')}</span>
                    <span>${pokemon.types.map(t => t.type.name).join(' / ')}</span>
                    <span>Altura: ${pokemon.height / 10}m | Peso: ${pokemon.weight / 10}kg</span>
                </div>

                <div class="card-tabs">
                    <button class="card-tab-btn active" data-tab-target="attacks">Ataques</button>
                    <button class="card-tab-btn" data-tab-target="info">Tipo e descrição</button>
                </div>

                <div class="tab-content" id="tab-attacks">
                    <div class="attacks">
                        ${attacksHTML}
                    </div>
                </div>

                <div class="tab-content hidden" id="tab-info">
                    <div class="info-tab-panel">
                        <div>
                            <div class="info-block-title">Tipo</div>
                            <div class="info-block-text">${pokemon.types.map(t => t.type.name).join(' / ')}</div>
                        </div>
                        <div>
                            <div class="info-block-title">Descrição</div>
                            <div class="info-block-text">${pokemonDescription}</div>
                        </div>
                    </div>
                </div>
                
                <div class="ex-rule">
                    <strong>Habilidades:</strong> Características especiais deste Pokémon.
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

            bindCardTabs();
        }

        function bindCardTabs() {
            const buttons = document.querySelectorAll('.card-tab-btn');
            const attacksPanel = document.getElementById('tab-attacks');
            const infoPanel = document.getElementById('tab-info');

            buttons.forEach((button) => {
                button.addEventListener('click', () => {
                    const target = button.getAttribute('data-tab-target');

                    buttons.forEach((btn) => btn.classList.remove('active'));
                    button.classList.add('active');

                    if (target === 'info') {
                        infoPanel?.classList.remove('hidden');
                        attacksPanel?.classList.add('hidden');
                    } else {
                        attacksPanel?.classList.remove('hidden');
                        infoPanel?.classList.add('hidden');
                    }
                });
            });
        }

        function initializeModalTabs() {
            const tabButtons = document.querySelectorAll('.modal-tab-btn');
            const basicTab = document.getElementById('modal-tab-basic');
            const attacksTab = document.getElementById('modal-tab-attacks');

            tabButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const tab = button.getAttribute('data-modal-tab');
                    tabButtons.forEach((b) => b.classList.remove('active'));
                    button.classList.add('active');

                    if (tab === 'attacks') {
                        attacksTab?.classList.remove('hidden');
                        basicTab?.classList.add('hidden');
                    } else {
                        basicTab?.classList.remove('hidden');
                        attacksTab?.classList.add('hidden');
                    }
                });
            });
        }

        function buildAttackInputs(count) {
            const builder = document.getElementById('attacksBuilder');
            if (!builder) return;

            const safeCount = Math.max(1, Math.min(6, Number(count) || 1));
            builder.innerHTML = '';

            for (let i = 0; i < safeCount; i++) {
                const row = document.createElement('div');
                row.className = 'attack-builder-row';
                row.innerHTML = `
                    <div class="attack-builder-title">Ataque ${i + 1}</div>
                    <label>Nome do ataque
                        <input type="text" class="attack-name-input" maxlength="100" placeholder="Ex.: Lâmina Sombria" />
                    </label>
                    <label>Dano
                        <input type="number" class="attack-damage-input" min="0" max="9999" placeholder="Ex.: 120" />
                    </label>
                    <label>Descrição
                        <textarea class="attack-description-input" placeholder="Descreva o efeito do ataque"></textarea>
                    </label>
                `;
                builder.appendChild(row);
            }
        }

        function collectAttacksFromModal() {
            const names = Array.from(document.querySelectorAll('.attack-name-input'));
            const damages = Array.from(document.querySelectorAll('.attack-damage-input'));
            const descriptions = Array.from(document.querySelectorAll('.attack-description-input'));

            const attacks = names.map((nameInput, idx) => ({
                name: (nameInput.value || '').trim(),
                damage: (damages[idx]?.value || '').trim(),
                description: (descriptions[idx]?.value || '').trim(),
            })).filter((attack) => attack.name || attack.damage || attack.description);

            return attacks;
        }

        function toggleFavorite() {
            if (!currentPokemon) {
                console.warn('Nenhum Pokémon carregado');
                return;
            }
            
            console.log('Toggle favorite para:', currentPokemon.name, 'ID:', currentPokemon.id);
            
            const index = favorites.indexOf(currentPokemon.id);
            if (index === -1) {
                favorites.push(currentPokemon.id);
                console.log('Adicionado aos favoritos');
            } else {
                favorites.splice(index, 1);
                console.log('Removido dos favoritos');
            }
            
            localStorage.setItem('pokemonFavorites', JSON.stringify(favorites));
            console.log('Favoritos salvos:', favorites);
            updateFavoriteButton();
            renderFavoritesList();
        }

        function updateFavoriteButton() {
            const btn = document.getElementById('favoriteBtn');
            
            if (!btn) {
                console.error('Botão favoriteBtn não encontrado');
                return;
            }
            
            const heart = btn.querySelector('.heart');
            
            if (!heart) {
                console.error('Elemento .heart não encontrado');
                return;
            }
            
            console.log('Atualizando botão. currentPokemon:', currentPokemon?.id, 'favorites:', favorites);
            
            if (currentPokemon && favorites.includes(currentPokemon.id)) {
                btn.classList.add('active');
                heart.innerHTML = '&#9829;';
                console.log('Botão marcado como ativo (favorito)');
            } else {
                btn.classList.remove('active');
                heart.innerHTML = '&#9825;';
                console.log('Botão marcado como inativo (não favorito)');
            }
        }

        // Event Listeners - Esperar pelo DOMContentLoaded para garantir que os elementos existem
        function initializeEventListeners() {
            const newPokemonBtn = document.getElementById('newPokemonBtn');
            const favoriteBtn = document.getElementById('favoriteBtn');
            const searchBtn = document.getElementById('searchBtn');
            const searchInput = document.getElementById('searchInput');
            const openCreateModalBtn = document.getElementById('openCreateModalBtn');
            const closeCreateModalBtn = document.getElementById('closeCreateModalBtn');
            const createPokemonModal = document.getElementById('createPokemonModal');
            const createPokemonForm = document.getElementById('createPokemonForm');
            const attackCountInput = document.getElementById('attackCountInput');
            const attacksJsonInput = document.getElementById('attacksJsonInput');

            initializeModalTabs();
            buildAttackInputs(attackCountInput?.value || 1);

            if (attackCountInput) {
                attackCountInput.addEventListener('input', function () {
                    buildAttackInputs(attackCountInput.value);
                });
            }
            
            if (newPokemonBtn) {
                newPokemonBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Clicou em Novo Pokémon');
                    fetchPokemon();
                });
            } else {
                console.error('Botão newPokemonBtn não encontrado');
            }
            
            if (favoriteBtn) {
                favoriteBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Clicou em Favoritar');
                    toggleFavorite();
                });
            } else {
                console.error('Botão favoriteBtn não encontrado');
            }

            if (searchBtn) {
                searchBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const query = searchInput.value;
                    if (query.trim()) {
                        console.log('Pesquisando por:', query);
                        fetchPokemon(query);
                    }
                });
            } else {
                console.error('Botão searchBtn não encontrado');
            }

            if (searchInput) {
                // Buscar ao pressionar Enter
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const query = searchInput.value;
                        if (query.trim()) {
                            console.log('Pesquisando por:', query);
                            fetchPokemon(query);
                        }
                    }
                });
            } else {
                console.error('Input searchInput não encontrado');
            }

            if (openCreateModalBtn && createPokemonModal) {
                openCreateModalBtn.addEventListener('click', function () {
                    createPokemonModal.classList.add('show');
                });
            }

            if (closeCreateModalBtn && createPokemonModal) {
                closeCreateModalBtn.addEventListener('click', function () {
                    createPokemonModal.classList.remove('show');
                });
            }

            if (createPokemonModal) {
                createPokemonModal.addEventListener('click', function (e) {
                    if (e.target === createPokemonModal) {
                        createPokemonModal.classList.remove('show');
                    }
                });
            }

            if (createPokemonForm) {
                createPokemonForm.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    const feedback = document.getElementById('createPokemonFeedback');
                    const submitBtn = document.getElementById('submitCreatePokemonBtn');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (attacksJsonInput) {
                        attacksJsonInput.value = JSON.stringify(collectAttacksFromModal());
                    }
                    const formData = new FormData(createPokemonForm);

                    feedback.textContent = 'Salvando...';
                    feedback.className = 'modal-feedback';
                    submitBtn.disabled = true;

                    try {
                        const response = await fetch('/pokemons', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken || '',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const data = await response.json().catch(() => ({}));

                        if (!response.ok) {
                            const validation = data.errors ? Object.values(data.errors).flat().join(' | ') : null;
                            throw new Error(validation || data.message || 'Não foi possível cadastrar o Pokémon.');
                        }

                        feedback.textContent = `Pokémon cadastrado com sucesso! ID: ${data?.pokemon?.id ?? '-'}`;
                        feedback.className = 'modal-feedback success';
                        createPokemonForm.reset();
                        buildAttackInputs(1);
                        if (attackCountInput) {
                            attackCountInput.value = 1;
                        }

                        if (createPokemonModal) {
                            setTimeout(() => createPokemonModal.classList.remove('show'), 600);
                        }

                        if (data?.pokemon) {
                            currentPokemon = data.pokemon;
                            renderCard(data.pokemon);
                            updateFavoriteButton();
                            if (searchInput) {
                                searchInput.value = data.pokemon.name || '';
                            }
                        }
                    } catch (error) {
                        feedback.textContent = error.message || 'Erro ao cadastrar Pokémon.';
                        feedback.className = 'modal-feedback error';
                    } finally {
                        submitBtn.disabled = false;
                    }
                });
            }
        }

        // Renderizar lista de favoritos
        async function renderFavoritesList() {
            const favoritesList = document.getElementById('favoritesList');
            
            if (!favoritesList) return;
            
            if (favorites.length === 0) {
                favoritesList.innerHTML = '<div class="favorites-empty">Adicione Pokémons aos favoritos!</div>';
                return;
            }
            
            favoritesList.innerHTML = '';
            
            for (const pokemonId of favorites) {
                try {
                    let pokemon;
                    if (Number(pokemonId) >= 1026) {
                        const localResponse = await fetch(`/pokemons/search?q=${encodeURIComponent(pokemonId)}`);
                        if (!localResponse.ok) {
                            continue;
                        }
                        const localData = await localResponse.json();
                        pokemon = localData.pokemon;
                    } else {
                        const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonId}`);
                        pokemon = await response.json();
                    }
                    
                    const favoriteItem = document.createElement('div');
                    favoriteItem.className = 'favorite-item';
                    favoriteItem.innerHTML = `
                        <img 
                            src="${pokemon.sprites.other['official-artwork'].front_default || pokemon.sprites.front_default}" 
                            alt="${pokemon.name}"
                        />
                        <div class="favorite-item-name">${pokemon.name}</div>
                        <div class="favorite-item-id">#${String(pokemon.id).padStart(4, '0')}</div>
                        <div class="remove-favorite">×</div>
                    `;
                    
                    // Click para carregar o Pokémon
                    favoriteItem.addEventListener('click', function(e) {
                        if (!e.target.classList.contains('remove-favorite')) {
                            currentPokemon = pokemon;
                            renderCard(pokemon);
                            updateFavoriteButton();
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                    });
                    
                    // Click no X para remover
                    const removeBtn = favoriteItem.querySelector('.remove-favorite');
                    removeBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        removeFavorite(pokemonId);
                    });
                    
                    favoritesList.appendChild(favoriteItem);
                } catch (error) {
                    console.error('Erro ao carregar favorito:', error);
                }
            }
        }

        function removeFavorite(pokemonId) {
            const index = favorites.indexOf(pokemonId);
            if (index !== -1) {
                favorites.splice(index, 1);
                localStorage.setItem('pokemonFavorites', JSON.stringify(favorites));
                renderFavoritesList();
                updateFavoriteButton();
            }
        }

        // Inicializar quando o DOM estiver pronto
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeEventListeners);
        } else {
            initializeEventListeners();
        }

        // Carregar Pokémon inicial e lista de favoritos
        fetchPokemon();
        renderFavoritesList();
    </script>
</body>
</html>