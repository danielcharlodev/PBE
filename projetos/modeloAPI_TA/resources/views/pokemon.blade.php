<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Card Pokémon</title>
    <style>
        /* ─── Reset & Base ─────────────────────────────────────────────── */
        *, *::before, *::after {
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

        /* ─── Layout ────────────────────────────────────────────────────── */
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

        /* ─── Search ────────────────────────────────────────────────────── */
        .search-container {
            display: flex;
            gap: 12px;
            width: 100%;
            max-width: 500px;
        }

        .search-input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            color: white;
            font-size: 14px;
            font-weight: 500;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }

        .search-input::placeholder { color: rgba(255, 255, 255, 0.45); }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        /* ─── Favoritos ─────────────────────────────────────────────────── */
        .favorites-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 340px;
        }

        .favorites-title {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .favorites-list {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
            background: rgba(255, 255, 255, 0.04);
            padding: 10px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            max-height: 260px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #3b82f6 transparent;
        }

        .favorites-list::-webkit-scrollbar { width: 6px; }
        .favorites-list::-webkit-scrollbar-track { background: transparent; }
        .favorites-list::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 999px;
        }

        .favorite-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            padding: 6px 4px;
            background: rgba(59, 130, 246, 0.18);
            border: 1px solid rgba(59, 130, 246, 0.25);
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.18s, box-shadow 0.18s;
            position: relative;
        }

        .favorite-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.35);
        }

        .favorite-item img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .favorite-item-name {
            font-size: 8px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-align: center;
            text-transform: capitalize;
            line-height: 1.2;
        }

        .favorite-item-id {
            font-size: 7px;
            color: rgba(255, 255, 255, 0.5);
        }

        .remove-favorite {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            background: #ef4444;
            border: 2px solid #0f172a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            line-height: 1;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.18s;
        }

        .favorite-item:hover .remove-favorite { opacity: 1; }

        /* ─── Card Section ──────────────────────────────────────────────── */
        .card-section {
            display: flex;
            flex-direction: column;
            gap: 14px;
            align-items: center;
        }

        .card-wrapper { perspective: 1000px; }

        .pokemon-card {
            width: 400px;
            height: 580px;
            border-radius: 18px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.1s ease-out;
            cursor: pointer;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 60px rgba(255,215,0,0.08);
        }

        .pokemon-card:hover {
            box-shadow: 0 30px 60px rgba(0,0,0,0.5), 0 0 80px rgba(255,215,0,0.18);
        }

        .card-inner {
            width: 100%;
            height: 100%;
            border-radius: 18px;
            padding: 12px;
            position: relative;
            overflow: hidden;
        }

        /* ─── Tipo Gradients ────────────────────────────────────────────── */
        .type-fire     { background: linear-gradient(145deg, #ff6b35, #f7931e, #ffcc00); }
        .type-water    { background: linear-gradient(145deg, #3b82f6, #06b6d4, #22d3ee); }
        .type-grass    { background: linear-gradient(145deg, #22c55e, #84cc16, #a3e635); }
        .type-electric { background: linear-gradient(145deg, #facc15, #fbbf24, #fcd34d); }
        .type-psychic  { background: linear-gradient(145deg, #ec4899, #f472b6, #f9a8d4); }
        .type-ice      { background: linear-gradient(145deg, #67e8f9, #a5f3fc, #cffafe); }
        .type-dragon   { background: linear-gradient(145deg, #7c3aed, #8b5cf6, #a78bfa); }
        .type-dark     { background: linear-gradient(145deg, #374151, #4b5563, #6b7280); }
        .type-fairy    { background: linear-gradient(145deg, #f9a8d4, #fbcfe8, #fce7f3); }
        .type-fighting { background: linear-gradient(145deg, #dc2626, #ef4444, #f87171); }
        .type-flying   { background: linear-gradient(145deg, #a78bfa, #c4b5fd, #ddd6fe); }
        .type-poison   { background: linear-gradient(145deg, #a855f7, #c084fc, #d8b4fe); }
        .type-ground   { background: linear-gradient(145deg, #d97706, #f59e0b, #fbbf24); }
        .type-rock     { background: linear-gradient(145deg, #78716c, #a8a29e, #d6d3d1); }
        .type-bug      { background: linear-gradient(145deg, #65a30d, #84cc16, #a3e635); }
        .type-ghost    { background: linear-gradient(145deg, #6366f1, #818cf8, #a5b4fc); }
        .type-steel    { background: linear-gradient(145deg, #9ca3af, #d1d5db, #e5e7eb); }
        .type-normal   { background: linear-gradient(145deg, #a8a29e, #d6d3d1, #e7e5e4); }

        /* ─── Holo Effects ──────────────────────────────────────────────── */
        .holo-effect {
            position: absolute;
            inset: 0;
            background: linear-gradient(125deg,
                transparent 0%,
                rgba(255,255,255,0.08) 25%,
                rgba(255,255,255,0.25) 50%,
                rgba(255,255,255,0.08) 75%,
                transparent 100%
            );
            background-size: 400% 100%;
            animation: shimmer 3s infinite linear;
            pointer-events: none;
            border-radius: 18px;
        }

        .rainbow-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg,
                rgba(255,0,0,0.08), rgba(255,127,0,0.08),
                rgba(255,255,0,0.08), rgba(0,255,0,0.08),
                rgba(0,0,255,0.08), rgba(75,0,130,0.08),
                rgba(143,0,255,0.08)
            );
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
            border-radius: 18px;
            mix-blend-mode: overlay;
        }

        .pokemon-card:hover .rainbow-overlay { opacity: 1; }

        @keyframes shimmer {
            0%   { background-position: -200% 0; }
            100% { background-position:  200% 0; }
        }

        /* ─── Card Content ──────────────────────────────────────────────── */
        .card-content {
            background: #fffef5;
            border-radius: 12px;
            height: 100%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 3px solid rgba(0,0,0,0.08);
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
            width: 22px;
            height: 22px;
            border-radius: 50%;
            margin-left: 4px;
        }

        /* ─── Pokémon Image ─────────────────────────────────────────────── */
        .pokemon-image-container {
            background: linear-gradient(180deg, #e8e8e8, #d0d0d0);
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
            object-fit: contain;
            filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.25));
            transition: transform 0.3s;
        }

        .pokemon-card:hover .pokemon-image { transform: scale(1.05); }

        .pokemon-info-bar {
            display: flex;
            justify-content: space-between;
            font-size: 8px;
            color: #666;
            padding: 2px 4px;
            background: rgba(0,0,0,0.04);
            border-radius: 4px;
            margin-bottom: 8px;
        }

        /* ─── Card Tabs ─────────────────────────────────────────────────── */
        .card-tabs {
            display: flex;
            gap: 6px;
            margin-bottom: 8px;
        }

        .card-tab-btn {
            border: 1px solid #d1d5db;
            background: #f3f4f6;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }

        .card-tab-btn.active {
            background: #1f2937;
            color: #fff;
            border-color: #1f2937;
        }

        .tab-content { flex: 1; overflow-y: auto; }

        .hidden { display: none !important; }

        .info-tab-panel {
            background: rgba(0,0,0,0.03);
            border-radius: 8px;
            padding: 8px;
            display: grid;
            gap: 8px;
        }

        .info-block-title { font-size: 11px; font-weight: 700; color: #111827; }
        .info-block-text  { font-size: 11px; line-height: 1.4; color: #374151; }

        /* ─── Attacks ───────────────────────────────────────────────────── */
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
            background: rgba(0,0,0,0.02);
            border-radius: 6px;
        }

        .attack-cost { display: flex; gap: 2px; min-width: 40px; }

        .energy {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 1px solid rgba(0,0,0,0.15);
        }

        .energy-fire      { background: radial-gradient(circle at 30% 30%, #ff6b35, #dc2626); }
        .energy-water     { background: radial-gradient(circle at 30% 30%, #60a5fa, #2563eb); }
        .energy-grass     { background: radial-gradient(circle at 30% 30%, #4ade80, #16a34a); }
        .energy-electric  { background: radial-gradient(circle at 30% 30%, #fde047, #eab308); }
        .energy-psychic   { background: radial-gradient(circle at 30% 30%, #f472b6, #db2777); }
        .energy-fighting  { background: radial-gradient(circle at 30% 30%, #f87171, #dc2626); }
        .energy-colorless { background: radial-gradient(circle at 30% 30%, #e5e5e5, #a3a3a3); }
        .energy-dark      { background: radial-gradient(circle at 30% 30%, #6b7280, #374151); }
        .energy-dragon    { background: radial-gradient(circle at 30% 30%, #a78bfa, #7c3aed); }
        .energy-fairy     { background: radial-gradient(circle at 30% 30%, #f9a8d4, #ec4899); }
        .energy-steel     { background: radial-gradient(circle at 30% 30%, #d1d5db, #9ca3af); }
        .energy-ice       { background: radial-gradient(circle at 30% 30%, #a5f3fc, #67e8f9); }
        .energy-poison    { background: radial-gradient(circle at 30% 30%, #d8b4fe, #a855f7); }
        .energy-ground    { background: radial-gradient(circle at 30% 30%, #fbbf24, #d97706); }
        .energy-rock      { background: radial-gradient(circle at 30% 30%, #a8a29e, #78716c); }
        .energy-bug       { background: radial-gradient(circle at 30% 30%, #a3e635, #65a30d); }
        .energy-ghost     { background: radial-gradient(circle at 30% 30%, #818cf8, #6366f1); }
        .energy-flying    { background: radial-gradient(circle at 30% 30%, #c4b5fd, #a78bfa); }
        .energy-normal    { background: radial-gradient(circle at 30% 30%, #d6d3d1, #a8a29e); }

        .attack-info { flex: 1; }

        .attack-name {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .attack-description { font-size: 9px; color: #666; line-height: 1.3; }

        .attack-damage {
            font-size: 20px;
            font-weight: 800;
            color: #1a1a1a;
            min-width: 40px;
            text-align: right;
        }

        /* ─── Card Footer ───────────────────────────────────────────────── */
        .ex-rule {
            font-size: 8px;
            color: #666;
            font-style: italic;
            padding: 4px;
            border-top: 1px solid rgba(0,0,0,0.08);
            margin-top: 4px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            padding-top: 6px;
            border-top: 1px solid rgba(0,0,0,0.08);
            font-size: 10px;
        }

        .stat-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .stat-label { font-size: 8px; color: #888; text-transform: uppercase; }

        .stat-value { display: flex; align-items: center; gap: 4px; }

        .weakness-icon, .resistance-icon {
            width: 14px;
            height: 14px;
            border-radius: 50%;
        }

        .retreat-cost { display: flex; gap: 2px; }

        .retreat-energy {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, #e5e5e5, #a3a3a3);
            border: 1px solid rgba(0,0,0,0.15);
        }

        .pokemon-id {
            position: absolute;
            bottom: 4px;
            right: 8px;
            font-size: 8px;
            color: #bbb;
        }

        /* ─── Loading ───────────────────────────────────────────────────── */
        .loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #666;
        }

        .spinner {
            width: 36px;
            height: 36px;
            border: 3px solid #e5e7eb;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ─── Buttons ───────────────────────────────────────────────────── */
        .buttons {
            display: flex;
            gap: 10px;
            width: 400px;
        }

        .btn {
            flex: 1;
            padding: 12px 16px;
            border: none;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.18s, box-shadow 0.18s, background 0.18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 14px rgba(59,130,246,0.35);
        }

        .btn-primary:hover { box-shadow: 0 6px 20px rgba(59,130,246,0.5); }

        .btn-success {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
            box-shadow: 0 4px 14px rgba(22,163,74,0.35);
        }

        .btn-success:hover { box-shadow: 0 6px 20px rgba(22,163,74,0.5); }

        .btn-search {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 14px rgba(59,130,246,0.35);
        }

        .btn-search:hover { box-shadow: 0 6px 20px rgba(59,130,246,0.5); }

        .btn-ghost {
            background: rgba(255,255,255,0.08);
            color: white;
            border: 1px solid rgba(255,255,255,0.18);
        }

        .btn-ghost:hover { background: rgba(255,255,255,0.14); }

        .btn-favorite {
            background: rgba(255,255,255,0.08);
            color: white;
            border: 1px solid rgba(255,255,255,0.18);
        }

        .btn-favorite:hover { background: rgba(255,255,255,0.14); }

        .btn-favorite.active {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-color: transparent;
            box-shadow: 0 4px 14px rgba(239,68,68,0.35);
        }

        .heart {
            font-size: 16px;
            transition: transform 0.18s;
            line-height: 1;
        }

        .btn-favorite:hover .heart { transform: scale(1.25); }

        /* ─── Modal Overlay ─────────────────────────────────────────────── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.72);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 999;
        }

        .modal-overlay.show { display: flex; }

        /* ─── Modal Card ────────────────────────────────────────────────── */
        .modal-card {
            width: 100%;
            max-width: 580px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            overflow: visible;
            box-shadow: 0 24px 60px rgba(0,0,0,0.5), 0 0 40px rgba(59,130,246,0.1);
            color: #f3f4f6;
        }

        .modal-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.3px;
            color: #f9fafb;
        }

        .modal-close-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 8px;
            background: rgba(255,255,255,0.06);
            color: #9ca3af;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: background 0.15s, color 0.15s;
        }

        .modal-close-btn:hover {
            background: rgba(239,68,68,0.2);
            color: #fca5a5;
        }

        /* ─── Modal Tabs ────────────────────────────────────────────────── */
        .modal-tabs {
            display: flex;
            gap: 6px;
            padding: 14px 24px 0;
            flex-shrink: 0;
        }

        .modal-tab-btn {
            padding: 7px 16px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
            color: #9ca3af;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }

        .modal-tab-btn.active {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        /* ─── Modal Form ────────────────────────────────────────────────── */
        .modal-body {
            flex: 1 1 auto;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 18px 24px;
            scrollbar-width: thin;
            scrollbar-color: #3b82f6 transparent;
            min-height: 0;
            max-height: calc(90vh - 180px);
        }

        .modal-body::-webkit-scrollbar { width: 6px; }
        .modal-body::-webkit-scrollbar-track { background: transparent; }
        .modal-body::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 999px;
        }

        .modal-tab-content {
            display: flex;
            flex-direction: column;
            gap: 14px;
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* ─── Form Fields ────────────────────────────────���──────────────── */
        .form-group { display: flex; flex-direction: column; gap: 6px; }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #d1d5db;
        }

        .form-label span {
            color: #6b7280;
            font-weight: 400;
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 10px 13px;
            color: #f9fafb;
            font-size: 13px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
        }

        .form-control option {
            background: #1e293b;
            color: #f9fafb;
        }

        textarea.form-control {
            min-height: 80px;
            resize: vertical;
            line-height: 1.5;
        }

        /* ─── Attack Builder ────────────────────────────────────────────── */
        .attacks-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .attacks-count-label {
            font-size: 12px;
            font-weight: 600;
            color: #d1d5db;
        }

        .attacks-count-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .count-btn {
            width: 28px;
            height: 28px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.06);
            color: #d1d5db;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }

        .count-btn:hover { background: rgba(59,130,246,0.2); color: #93c5fd; }
        .count-btn:disabled { opacity: 0.35; cursor: not-allowed; }

        .count-display {
            font-size: 14px;
            font-weight: 700;
            color: #f9fafb;
            min-width: 20px;
            text-align: center;
        }

        #attacksBuilder {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-height: calc(90vh - 320px);
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 4px;
            scrollbar-width: thin;
            scrollbar-color: #3b82f6 transparent;
        }

        #attacksBuilder::-webkit-scrollbar { width: 6px; }
        #attacksBuilder::-webkit-scrollbar-track { background: transparent; }
        #attacksBuilder::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 999px;
        }

        .attack-builder-row {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: border-color 0.2s;
        }

        .attack-builder-row:hover {
            border-color: rgba(59,130,246,0.3);
        }

        .attack-builder-title {
            font-size: 12px;
            font-weight: 700;
            color: #93c5fd;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ─── Modal Footer ──────────────────────────────────────────────── */
        .modal-footer {
            padding: 14px 24px;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-shrink: 0;
        }

        .modal-feedback {
            font-size: 12px;
            min-height: 16px;
            color: transparent;
        }

        .modal-feedback.loading { color: #93c5fd; }
        .modal-feedback.error   { color: #fca5a5; }
        .modal-feedback.success { color: #86efac; }

        .modal-actions { display: flex; gap: 8px; }

        .btn-sm {
            padding: 9px 18px;
            font-size: 13px;
            border-radius: 10px;
        }

        /* ─── Type Selector (Dual Type) ─────────────────────────────────── */
        .type-selector-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .type-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            min-height: 32px;
            padding: 8px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
        }

        .type-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .type-badge:hover {
            transform: scale(1.05);
        }

        .type-badge .remove-type {
            font-size: 14px;
            line-height: 1;
            opacity: 0.7;
            transition: opacity 0.15s;
        }

        .type-badge:hover .remove-type {
            opacity: 1;
        }

        .type-badge.type-normal   { background: #a8a29e; color: #1a1a1a; }
        .type-badge.type-fire     { background: #ff6b35; color: white; }
        .type-badge.type-water    { background: #3b82f6; color: white; }
        .type-badge.type-grass    { background: #22c55e; color: white; }
        .type-badge.type-electric { background: #facc15; color: #1a1a1a; }
        .type-badge.type-ice      { background: #67e8f9; color: #1a1a1a; }
        .type-badge.type-fighting { background: #dc2626; color: white; }
        .type-badge.type-poison   { background: #a855f7; color: white; }
        .type-badge.type-ground   { background: #d97706; color: white; }
        .type-badge.type-flying   { background: #a78bfa; color: #1a1a1a; }
        .type-badge.type-psychic  { background: #ec4899; color: white; }
        .type-badge.type-bug      { background: #65a30d; color: white; }
        .type-badge.type-rock     { background: #78716c; color: white; }
        .type-badge.type-ghost    { background: #6366f1; color: white; }
        .type-badge.type-dragon   { background: #7c3aed; color: white; }
        .type-badge.type-dark     { background: #374151; color: white; }
        .type-badge.type-steel    { background: #9ca3af; color: #1a1a1a; }
        .type-badge.type-fairy    { background: #f9a8d4; color: #1a1a1a; }

        .type-select-hint {
            font-size: 10px;
            color: #6b7280;
        }

        .type-empty-hint {
            font-size: 11px;
            color: #6b7280;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">

    {{-- Barra de pesquisa --}}
    <div class="search-container">
        <input
            type="text"
            class="search-input"
            id="searchInput"
            placeholder="Nome ou número da Pokédex…"
        />
        <button class="btn btn-search" id="searchBtn" style="flex:0;padding:12px 20px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            Buscar
        </button>
    </div>

    <div class="main-content">

        {{-- Favoritos --}}
        <div class="favorites-container">
            <div class="favorites-title">⭐ Favoritos</div>
            <div class="favorites-list" id="favoritesList"></div>
        </div>

        {{-- Card + botões --}}
        <div class="card-section">
            <div class="card-wrapper">
                <div class="pokemon-card" id="pokemonCard">
                    <div class="card-inner type-normal" id="cardInner">
                        <div class="holo-effect"></div>
                        <div class="rainbow-overlay"></div>
                        <div class="card-content" id="cardContent">
                            <div class="loading" id="loading">
                                <div class="spinner"></div>
                                <p style="margin-top:12px;font-size:13px;">Carregando Pokémon…</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="buttons">
                <button class="btn btn-primary" id="newPokemonBtn">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M23 4v6h-6M1 20v-6h6M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15"/>
                    </svg>
                    Aleatório
                </button>

                <button class="btn btn-success" id="openCreateModalBtn">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8v8M8 12h8"/>
                    </svg>
                    Cadastrar
                </button>

                <button class="btn btn-favorite" id="favoriteBtn">
                    <span class="heart">&#9825;</span>
                    Favoritar
                </button>
            </div>
        </div>

    </div>
</div>

{{-- ╔══════════════════════════════════════════════════════════╗ --}}
{{--   Modal — Cadastrar Pokémon                               --}}
{{-- ╚══════════════════════════════════════════════════════════╝ --}}
<div class="modal-overlay" id="createPokemonModal">
    <div class="modal-card">

        {{-- Cabeçalho --}}
        <div class="modal-header">
            <h2 class="modal-title">Cadastrar Pokémon</h2>
            <button class="modal-close-btn" id="closeCreateModalBtn" type="button" title="Fechar">×</button>
        </div>

        {{-- Abas --}}
        <div class="modal-tabs">
            <button type="button" class="modal-tab-btn active" data-modal-tab="basic">Dados Básicos</button>
            <button type="button" class="modal-tab-btn" data-modal-tab="attacks">Ataques</button>
        </div>

        {{-- Formulário --}}
        <form id="createPokemonForm">
            <div class="modal-body">

                {{-- Aba: Dados Básicos --}}
                <div class="modal-tab-content" id="modal-tab-basic">

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label" for="field-name">Nome</label>
                            <input
                                type="text"
                                class="form-control"
                                id="field-name"
                                name="name"
                                placeholder="Ex.: Charizard"
                                maxlength="100"
                                required
                            />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="field-power">
                                Poder <span>(HP base)</span>
                            </label>
                            <input
                                type="number"
                                class="form-control"
                                id="field-power"
                                name="power"
                                placeholder="Ex.: 150"
                                min="1"
                                max="9999"
                                required
                            />
                        </div>
                    </div>

                    {{-- Seletor de Tipos (até 2) --}}
                    <div class="form-group">
                        <label class="form-label">
                            Tipos <span>(selecione até 2)</span>
                        </label>
                        <div class="type-selector-container">
                            <div class="type-badges" id="selectedTypesBadges">
                                <span class="type-empty-hint">Nenhum tipo selecionado</span>
                            </div>
                            <select class="form-control" id="field-type-selector">
                                <option value="" disabled selected>Adicionar tipo…</option>
                                <option value="normal">Normal</option>
                                <option value="fire">Fire</option>
                                <option value="water">Water</option>
                                <option value="grass">Grass</option>
                                <option value="electric">Electric</option>
                                <option value="ice">Ice</option>
                                <option value="fighting">Fighting</option>
                                <option value="poison">Poison</option>
                                <option value="ground">Ground</option>
                                <option value="flying">Flying</option>
                                <option value="psychic">Psychic</option>
                                <option value="bug">Bug</option>
                                <option value="rock">Rock</option>
                                <option value="ghost">Ghost</option>
                                <option value="dragon">Dragon</option>
                                <option value="dark">Dark</option>
                                <option value="steel">Steel</option>
                                <option value="fairy">Fairy</option>
                            </select>
                            <input type="hidden" name="type" id="field-type-primary" />
                            <input type="hidden" name="type_secondary" id="field-type-secondary" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="field-description">Descrição</label>
                        <textarea
                            class="form-control"
                            id="field-description"
                            name="description"
                            placeholder="Descreva as características deste Pokémon…"
                            required
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="field-photo">
                            Imagem <span>(opcional)</span>
                        </label>
                        <input
                            type="file"
                            class="form-control"
                            id="field-photo"
                            name="photo"
                            accept="image/*"
                        />
                    </div>

                </div>

                {{-- Aba: Ataques --}}
                <div class="modal-tab-content hidden" id="modal-tab-attacks">

                    <div class="attacks-header">
                        <span class="attacks-count-label">Número de ataques</span>
                        <div class="attacks-count-control">
                            <button type="button" class="count-btn" id="attackDecBtn">−</button>
                            <span class="count-display" id="attackCountDisplay">1</span>
                            <button type="button" class="count-btn" id="attackIncBtn">+</button>
                            <input type="hidden" id="attackCountInput" value="1" />
                        </div>
                    </div>

                    <div id="attacksBuilder"></div>
                    <input type="hidden" name="attacks_json" id="attacksJsonInput" />

                </div>

            </div>{{-- /modal-body --}}

            {{-- Rodapé --}}
            <div class="modal-footer">
                <span class="modal-feedback" id="createPokemonFeedback"></span>
                <div class="modal-actions">
                    <button type="button" class="btn btn-ghost btn-sm" id="cancelCreateModalBtn">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm" id="submitCreatePokemonBtn">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Salvar
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>

<script>
    /* ──────────────────────────────────────────────────────────────
       Constantes e estado
    ────────────────────────────────────────────────────────────── */
    const TYPE_CLASSES = {
        fire:'type-fire', water:'type-water', grass:'type-grass',
        electric:'type-electric', psychic:'type-psychic', ice:'type-ice',
        dragon:'type-dragon', dark:'type-dark', fairy:'type-fairy',
        fighting:'type-fighting', flying:'type-flying', poison:'type-poison',
        ground:'type-ground', rock:'type-rock', bug:'type-bug',
        ghost:'type-ghost', steel:'type-steel', normal:'type-normal',
    };

    const TYPE_WEAKNESSES = {
        fire:'water', water:'electric', grass:'fire', electric:'ground',
        psychic:'dark', ice:'fire', dragon:'dragon', dark:'fighting',
        fairy:'steel', fighting:'psychic', flying:'electric', poison:'ground',
        ground:'water', rock:'water', bug:'fire', ghost:'dark',
        steel:'fire', normal:'fighting',
    };

    let currentPokemon = null;
    let favorites = JSON.parse(localStorage.getItem('pokemonFavorites') || '[]');
    let attackCount = 1;
    let selectedTypes = []; // Array para armazenar até 2 tipos

    /* ──────────────────────────────────────────────────────────────
       Card — efeito tilt 3D
    ────────────────────────────────────────────────────────────── */
    const card = document.getElementById('pokemonCard');

    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const rotateX = ((e.clientY - rect.top)  - rect.height / 2) / 12;
        const rotateY = (rect.width  / 2 - (e.clientX - rect.left)) / 12;
        card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'rotateX(0) rotateY(0)';
    });

    /* ──────────────────────────────────────────────────────────────
       Buscar Pokémon
    ────────────────────────────────────────────────────────────── */
    async function fetchPokemon(query = null) {
        const cardContent = document.getElementById('cardContent');
        cardContent.innerHTML = '<div class="loading"><div class="spinner"></div><p style="margin-top:12px;font-size:13px;">Carregando…</p></div>';

        try {
            let pokemon;

            if (query) {
                const res = await fetch(`/pokemons/search?q=${encodeURIComponent(query.trim())}`);
                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    throw new Error(err.message || `"${query}" não encontrado.`);
                }
                pokemon = (await res.json()).pokemon;
            } else {
                const id  = Math.floor(Math.random() * 898) + 1;
                const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
                if (!res.ok) throw new Error('Falha ao buscar Pokémon aleatório.');
                pokemon   = await res.json();
            }

            currentPokemon = pokemon;
            renderCard(pokemon);
            updateFavoriteButton();
        } catch (err) {
            cardContent.innerHTML = `<div class="loading"><p style="color:#f87171;font-size:13px;">❌ ${err.message}</p></div>`;
        }
    }

    /* ──────────────────────────────────────────────────────────────
       Renderizar Card
    ─────────��──────────────────────────────────────────────────── */
    function renderCard(pokemon) {
        const cardInner   = document.getElementById('cardInner');
        const cardContent = document.getElementById('cardContent');

        const type       = pokemon.types[0].type.name;
        const hp         = pokemon.stats.find(s => s.stat.name === 'hp').base_stat;
        const weakness   = TYPE_WEAKNESSES[type] || 'fighting';
        const imageUrl   = pokemon?.sprites?.other?.['official-artwork']?.front_default
                        || pokemon?.sprites?.front_default
                        || 'https://via.placeholder.com/160?text=?';

        cardInner.className = `card-inner ${TYPE_CLASSES[type] || 'type-normal'}`;

        const customAttacks  = Array.isArray(pokemon.custom_attacks) ? pokemon.custom_attacks : [];
        const isLocalPokemon = Boolean(pokemon.isLocal || pokemon.descricao || pokemon.custom_attacks);

        const attacksHTML = customAttacks.length > 0
            ? customAttacks.map(move => `
                <div class="attack">
                    <div class="attack-cost"><div class="energy energy-${type}"></div></div>
                    <div class="attack-info">
                        <div class="attack-name">${escapeHtml((move.name || 'Ataque').toUpperCase())}</div>
                        <div class="attack-description">${escapeHtml(move.description || '')}</div>
                    </div>
                    <div class="attack-damage">${escapeHtml(String(move.damage || ''))}</div>
                </div>`).join('')
            : isLocalPokemon
                ? `<div class="attack">
                       <div class="attack-info">
                           <div class="attack-name">SEM ATAQUES</div>
                           <div class="attack-description">Nenhum ataque cadastrado para este Pokémon.</div>
                       </div>
                   </div>`
                : pokemon.abilities.slice(0, 3).map(a => `
                    <div class="attack">
                        <div class="attack-cost">
                            ${a.is_hidden
                                ? '<div style="font-size:10px;color:#fbbf24;font-weight:700;">H</div>'
                                : `<div class="energy energy-${type}"></div>`}
                        </div>
                        <div class="attack-info">
                            <div class="attack-name">${a.ability.name.replace('-', ' ').toUpperCase()}</div>
                            <div class="attack-description">${a.is_hidden ? 'Habilidade Oculta' : 'Habilidade'}</div>
                        </div>
                    </div>`).join('');

        const description   = pokemon.descricao || 'Sem descrição disponível.';
        const typeLabels    = pokemon.types.map(t => t.type.name).join(' / ');
        const retreatDots   = Array(Math.min(Math.ceil(pokemon.weight / 500), 4))
                                .fill('<div class="retreat-energy"></div>').join('');

        cardContent.innerHTML = `
            <div class="card-header">
                <div>
                    <div class="pokemon-stage">Básico</div>
                    <div class="pokemon-name-row">
                        <span class="pokemon-name">${escapeHtml(pokemon.name)}</span>
                        <span class="ex-badge">ex</span>
                    </div>
                </div>
                <div class="pokemon-hp">
                    <span class="hp-label">PS</span>
                    <span class="hp-value">${hp + 100}</span>
                    <div class="type-icon energy-${type}"></div>
                </div>
            </div>

            <div class="pokemon-image-container">
                <img src="${imageUrl}" alt="${escapeHtml(pokemon.name)}" class="pokemon-image"
                     onerror="this.src='https://via.placeholder.com/160?text=?'"/>
            </div>

            <div class="pokemon-info-bar">
                <span>Nº ${String(pokemon.id).padStart(4, '0')}</span>
                <span>${typeLabels}</span>
                <span>${pokemon.height / 10}m · ${pokemon.weight / 10}kg</span>
            </div>

            <div class="card-tabs">
                <button class="card-tab-btn active" data-tab-target="attacks">Ataques</button>
                <button class="card-tab-btn"        data-tab-target="info">Info</button>
            </div>

            <div class="tab-content" id="tab-attacks">
                <div class="attacks">${attacksHTML}</div>
            </div>

            <div class="tab-content hidden" id="tab-info">
                <div class="info-tab-panel">
                    <div>
                        <div class="info-block-title">Tipo</div>
                        <div class="info-block-text">${typeLabels}</div>
                    </div>
                    <div>
                        <div class="info-block-title">Descrição</div>
                        <div class="info-block-text">${escapeHtml(description)}</div>
                    </div>
                </div>
            </div>

            <div class="ex-rule"><strong>Regra ex:</strong> Quando este Pokémon-ex é nocauteado, seu oponente pega 2 Prêmios.</div>

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
                    <div class="stat-value"><span>—</span></div>
                </div>
                <div class="stat-group">
                    <span class="stat-label">Recuo</span>
                    <div class="retreat-cost">${retreatDots}</div>
                </div>
            </div>

            <div class="pokemon-id">Illus. Pokémon TCG</div>
        `;

        bindCardTabs();
    }

    /* ──────────────────────────────────────────────────────────────
       Abas do Card
    ────────────────────────────────────────────────────────────── */
    function bindCardTabs() {
        document.querySelectorAll('.card-tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-tab-target');
                document.querySelectorAll('.card-tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('tab-attacks')?.classList.toggle('hidden', target !== 'attacks');
                document.getElementById('tab-info')?.classList.toggle('hidden', target !== 'info');
            });
        });
    }

    /* ──────────────────────────────────────────────────────────────
       Favoritos
    ──────────────────────────��─────────────────────────────────── */
    function toggleFavorite() {
        if (!currentPokemon) return;
        const idx = favorites.indexOf(currentPokemon.id);
        if (idx === -1) favorites.push(currentPokemon.id);
        else favorites.splice(idx, 1);
        localStorage.setItem('pokemonFavorites', JSON.stringify(favorites));
        updateFavoriteButton();
        renderFavoritesList();
    }

    function updateFavoriteButton() {
        const btn   = document.getElementById('favoriteBtn');
        const heart = btn?.querySelector('.heart');
        if (!btn || !heart) return;
        const isFav = currentPokemon && favorites.includes(currentPokemon.id);
        btn.classList.toggle('active', isFav);
        heart.innerHTML = isFav ? '&#9829;' : '&#9825;';
    }

    async function renderFavoritesList() {
        const list = document.getElementById('favoritesList');
        if (!list) return;
        list.innerHTML = '';

        for (const pokemonId of favorites) {
            try {
                let pokemon;
                if (Number(pokemonId) >= 1026) {
                    const res = await fetch(`/pokemons/search?q=${encodeURIComponent(pokemonId)}`);
                    if (!res.ok) continue;
                    pokemon = (await res.json()).pokemon;
                } else {
                    const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonId}`);
                    pokemon   = await res.json();
                }

                const imgSrc = pokemon.sprites?.other?.['official-artwork']?.front_default
                            || pokemon.sprites?.front_default || '';

                const item = document.createElement('div');
                item.className = 'favorite-item';
                item.innerHTML = `
                    <img src="${imgSrc}" alt="${escapeHtml(pokemon.name)}" />
                    <div class="favorite-item-name">${escapeHtml(pokemon.name)}</div>
                    <div class="favorite-item-id">#${String(pokemon.id).padStart(4,'0')}</div>
                    <div class="remove-favorite" title="Remover">×</div>
                `;

                item.addEventListener('click', (e) => {
                    if (!e.target.classList.contains('remove-favorite')) {
                        currentPokemon = pokemon;
                        renderCard(pokemon);
                        updateFavoriteButton();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                });

                item.querySelector('.remove-favorite').addEventListener('click', (e) => {
                    e.stopPropagation();
                    removeFavorite(pokemonId);
                });

                list.appendChild(item);
            } catch { /* silencia erros individuais de favorito */ }
        }
    }

    function removeFavorite(pokemonId) {
        const idx = favorites.indexOf(pokemonId);
        if (idx !== -1) {
            favorites.splice(idx, 1);
            localStorage.setItem('pokemonFavorites', JSON.stringify(favorites));
            renderFavoritesList();
            updateFavoriteButton();
        }
    }

    /* ──────────────────────────────────────────────────────────────
       Modal — Abas
    ────────────────────────────────────────────────────────────── */
    function initModalTabs() {
        document.querySelectorAll('.modal-tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tab = btn.getAttribute('data-modal-tab');
                document.querySelectorAll('.modal-tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('modal-tab-basic')?.classList.toggle('hidden',   tab !== 'basic');
                document.getElementById('modal-tab-attacks')?.classList.toggle('hidden', tab !== 'attacks');
            });
        });
    }

    /* ──────────────────────────────────────────────────────────────
       Seletor de Tipos (até 2)
    ────────────────────────────────────────────────────────────── */
    function initTypeSelector() {
        const selector = document.getElementById('field-type-selector');
        const badgesContainer = document.getElementById('selectedTypesBadges');
        const primaryInput = document.getElementById('field-type-primary');
        const secondaryInput = document.getElementById('field-type-secondary');

        if (!selector || !badgesContainer) return;

        selector.addEventListener('change', () => {
            const selectedType = selector.value;
            
            if (selectedType && !selectedTypes.includes(selectedType) && selectedTypes.length < 2) {
                selectedTypes.push(selectedType);
                updateTypeBadges();
            }
            
            // Reset selector
            selector.value = '';
        });

        function updateTypeBadges() {
            // Atualiza os inputs hidden
            primaryInput.value = selectedTypes[0] || '';
            secondaryInput.value = selectedTypes[1] || '';

            // Renderiza os badges
            if (selectedTypes.length === 0) {
                badgesContainer.innerHTML = '<span class="type-empty-hint">Nenhum tipo selecionado</span>';
            } else {
                badgesContainer.innerHTML = selectedTypes.map((type, index) => `
                    <div class="type-badge type-${type}" data-type="${type}">
                        <span>${type}</span>
                        <span class="remove-type">×</span>
                    </div>
                `).join('');

                // Adiciona listeners para remover
                badgesContainer.querySelectorAll('.type-badge').forEach(badge => {
                    badge.addEventListener('click', () => {
                        const typeToRemove = badge.getAttribute('data-type');
                        selectedTypes = selectedTypes.filter(t => t !== typeToRemove);
                        updateTypeBadges();
                    });
                });
            }

            // Desabilita opções já selecionadas
            Array.from(selector.options).forEach(option => {
                if (option.value && selectedTypes.includes(option.value)) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });

            // Se já tem 2 tipos, desabilita o selector
            if (selectedTypes.length >= 2) {
                selector.disabled = true;
            } else {
                selector.disabled = false;
            }
        }

        // Expõe a função de reset
        window.resetTypeSelector = function() {
            selectedTypes = [];
            updateTypeBadges();
        };
    }

    /* ──────────────────────────────────────────────────────────────
       Builder de Ataques
    ────────────────────────────────────────────────────────────── */
    function buildAttackInputs(count) {
        const builder   = document.getElementById('attacksBuilder');
        const display   = document.getElementById('attackCountDisplay');
        const decBtn    = document.getElementById('attackDecBtn');
        const incBtn    = document.getElementById('attackIncBtn');
        if (!builder) return;

        attackCount     = Math.max(1, Math.min(4, Number(count) || 1));
        if (display)  display.textContent  = attackCount;
        if (decBtn)   decBtn.disabled      = attackCount <= 1;
        if (incBtn)   incBtn.disabled      = attackCount >= 4;
        document.getElementById('attackCountInput').value = attackCount;

        builder.innerHTML = '';
        for (let i = 0; i < attackCount; i++) {
            const row = document.createElement('div');
            row.className = 'attack-builder-row';
            row.innerHTML = `
                <div class="attack-builder-title">Ataque ${i + 1}</div>
                <div class="form-group">
                    <label class="form-label">Nome do ataque</label>
                    <input type="text" class="form-control attack-name-input" maxlength="100" placeholder="Ex.: Lâmina Sombria" />
                </div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Dano</label>
                        <input type="number" class="form-control attack-damage-input" min="0" max="9999" placeholder="Ex.: 120" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipo de energia</label>
                        <select class="form-control attack-energy-input">
                            <option value="">Padrão</option>
                            <option value="fire">Fire</option>
                            <option value="water">Water</option>
                            <option value="grass">Grass</option>
                            <option value="electric">Electric</option>
                            <option value="psychic">Psychic</option>
                            <option value="fighting">Fighting</option>
                            <option value="dark">Dark</option>
                            <option value="dragon">Dragon</option>
                            <option value="fairy">Fairy</option>
                            <option value="steel">Steel</option>
                            <option value="colorless">Colorless</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Descrição <span>(opcional)</span></label>
                    <textarea class="form-control attack-description-input" placeholder="Descreva o efeito do ataque…" rows="2"></textarea>
                </div>
            `;
            builder.appendChild(row);
        }
    }

    function collectAttacks() {
        const names       = [...document.querySelectorAll('.attack-name-input')];
        const damages     = [...document.querySelectorAll('.attack-damage-input')];
        const energies    = [...document.querySelectorAll('.attack-energy-input')];
        const descriptions= [...document.querySelectorAll('.attack-description-input')];

        return names
            .map((n, i) => ({
                name:        n.value.trim(),
                damage:      damages[i]?.value.trim()      || '',
                energy:      energies[i]?.value            || '',
                description: descriptions[i]?.value.trim() || '',
            }))
            .filter(a => a.name || a.damage);
    }

    /* ──────────────────────────────────────────────────────────────
       Utilitários
    ────────────────────────────────────────────────────────────── */
    function escapeHtml(str) {
        return String(str)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;')
            .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function setFeedback(el, message, type) {
        el.textContent  = message;
        el.className    = `modal-feedback ${type}`;
    }

    /* ──────────────────────────────────────────────────────────────
       Event Listeners
    ────────────────────────────────────────────────────────────── */
    function init() {
        /* — Pesquisa — */
        const searchBtn   = document.getElementById('searchBtn');
        const searchInput = document.getElementById('searchInput');

        searchBtn?.addEventListener('click', () => {
            if (searchInput.value.trim()) fetchPokemon(searchInput.value);
        });

        searchInput?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && searchInput.value.trim()) fetchPokemon(searchInput.value);
        });

        /* — Pokémon aleatório — */
        document.getElementById('newPokemonBtn')?.addEventListener('click', () => fetchPokemon());

        /* — Favoritar — */
        document.getElementById('favoriteBtn')?.addEventListener('click', toggleFavorite);

        /* — Abrir / fechar modal — */
        const modal = document.getElementById('createPokemonModal');

        document.getElementById('openCreateModalBtn')?.addEventListener('click', () => {
            modal?.classList.add('show');
        });

        function closeModal() { modal?.classList.remove('show'); }

        document.getElementById('closeCreateModalBtn')?.addEventListener('click', closeModal);
        document.getElementById('cancelCreateModalBtn')?.addEventListener('click', closeModal);

        modal?.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

        /* — Tecla Escape fecha o modal — */
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        /* — Contador de ataques — */
        document.getElementById('attackIncBtn')?.addEventListener('click', () => buildAttackInputs(attackCount + 1));
        document.getElementById('attackDecBtn')?.addEventListener('click', () => buildAttackInputs(attackCount - 1));

        /* — Abas do modal — */
        initModalTabs();
        buildAttackInputs(1);

        /* — Seletor de tipos — */
        initTypeSelector();

        /* — Submit do formulário — */
        const form      = document.getElementById('createPokemonForm');
        const feedback  = document.getElementById('createPokemonFeedback');
        const submitBtn = document.getElementById('submitCreatePokemonBtn');

        form?.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Validação: pelo menos um tipo deve ser selecionado
            if (selectedTypes.length === 0) {
                setFeedback(feedback, 'Selecione pelo menos um tipo para o Pokémon.', 'error');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            document.getElementById('attacksJsonInput').value = JSON.stringify(collectAttacks());

            const formData = new FormData(form);
            setFeedback(feedback, 'Salvando…', 'loading');
            submitBtn.disabled = true;

            try {
                const res  = await fetch('/pokemons', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken || '', 'Accept': 'application/json' },
                    body: formData,
                });

                const data = await res.json().catch(() => ({}));

                if (!res.ok) {
                    const msgs = data.errors
                        ? Object.values(data.errors).flat().join(' · ')
                        : (data.message || 'Não foi possível cadastrar o Pokémon.');
                    throw new Error(msgs);
                }

                setFeedback(feedback, `✓ Pokémon cadastrado com sucesso! ID: ${data?.pokemon?.id ?? '—'}`, 'success');
                form.reset();
                buildAttackInputs(1);
                
                // Reset do seletor de tipos
                if (window.resetTypeSelector) {
                    window.resetTypeSelector();
                }

                if (data?.pokemon) {
                    currentPokemon = data.pokemon;
                    renderCard(data.pokemon);
                    updateFavoriteButton();
                    if (searchInput) searchInput.value = data.pokemon.name || '';
                }

                setTimeout(() => closeModal(), 800);
            } catch (err) {
                setFeedback(feedback, err.message || 'Erro ao cadastrar Pokémon.', 'error');
            } finally {
                submitBtn.disabled = false;
            }
        });
    }

    /* ──────────────────────────────────────────────────────────────
       Bootstrap
    ────────────────────────────────────────────────────────────── */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    fetchPokemon();
    renderFavoritesList();
</script>
</body>
</html>
