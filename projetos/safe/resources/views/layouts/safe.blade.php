<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SENAI — Sistema de Acesso')</title>
    <link rel="icon" href="{{ \App\Support\SenaiBrand::faviconUrl() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #141414;
            --bg-soft: #1f1f1f;
            --page-bg: #eceef1;
            --surface: #ffffff;
            --surface-muted: #f7f8fa;
            --border: #dde1e8;
            --text: #1a1a1a;
            --text-muted: #5c6573;
            --primary: #e30613;
            --primary-soft: #fff0f1;
            --primary-hover: #c10510;
            --success: #15803d;
            --success-bg: #ecfdf3;
            --warning: #a16207;
            --warning-bg: #fffbeb;
            --danger: #b91c1c;
            --danger-bg: #fef2f2;
            --info-bg: #f1f5f9;
            --info: #334155;
            --radius: 10px;
            --radius-lg: 14px;
            --shadow-sm: 0 1px 2px rgba(16, 24, 40, 0.06);
            --shadow: 0 4px 14px rgba(16, 24, 40, 0.07);
            --shadow-md: 0 8px 24px rgba(16, 24, 40, 0.09);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Inter", "Segoe UI", system-ui, sans-serif;
            color: var(--text);
            background: var(--page-bg);
            min-height: 100vh;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        .app-header {
            background: var(--bg);
            color: white;
            padding: 0.9rem 1.5rem;
            border-bottom: 3px solid var(--primary);
        }

        .app-header-inner {
            max-width: 1040px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
            color: inherit;
        }

        .senai-logo-img {
            width: auto;
            display: block;
            object-fit: contain;
        }

        .brand-logo {
            height: 34px;
        }

        .brand h1 {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.06em;
        }

        .brand p {
            margin: 0.12rem 0 0;
            font-size: 0.76rem;
            color: rgba(255, 255, 255, 0.72);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
        }

        .user-pill {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.14);
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-size: 0.8rem;
        }

        .btn-ghost {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.28);
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .app-main {
            max-width: 1040px;
            margin: 0 auto;
            padding: 1.5rem 1.25rem 2.5rem;
        }

        .app-nav {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
            padding: 0.5rem;
            margin-bottom: 1.35rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .app-nav a {
            text-decoration: none;
            color: var(--text-muted);
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            font-size: 0.84rem;
            font-weight: 600;
            transition: background 0.15s, color 0.15s;
        }

        .app-nav a:hover {
            color: var(--text);
            background: var(--surface-muted);
        }

        .app-nav a.active {
            background: var(--primary);
            color: white;
        }

        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1rem;
            margin-bottom: 1.35rem;
            padding-bottom: 1.15rem;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .page-title {
            margin: 0;
            font-size: 1.45rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text);
        }

        .page-subtitle {
            margin: 0.35rem 0 0;
            color: var(--text-muted);
            font-size: 0.92rem;
            max-width: 52ch;
        }

        .section-title {
            margin: 0 0 0.85rem;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
        }

        .section-title--spaced {
            margin-top: 1.75rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            border: none;
            border-radius: 8px;
            padding: 0.62rem 1rem;
            font-size: 0.88rem;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s ease, box-shadow 0.15s ease, transform 0.15s ease;
        }

        .btn:hover { transform: translateY(-1px); }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 8px rgba(227, 6, 19, 0.28);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.32);
        }

        .btn-secondary {
            background: white;
            color: var(--text);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        .btn-secondary:hover { background: var(--surface-muted); }

        .btn-action {
            background: var(--primary);
            color: white;
            width: 100%;
            box-shadow: 0 2px 8px rgba(227, 6, 19, 0.22);
        }

        .btn-action:hover { background: var(--primary-hover); }

        .alert {
            padding: 0.85rem 1rem;
            border-radius: var(--radius);
            margin-bottom: 1.15rem;
            font-size: 0.9rem;
            border: 1px solid transparent;
        }

        .alert-success {
            background: var(--success-bg);
            color: #14532d;
            border-color: #bbf7d0;
        }

        .alert-error {
            background: var(--danger-bg);
            color: #7f1d1d;
            border-color: #fecaca;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.15rem 1.25rem;
            margin-bottom: 0.9rem;
            box-shadow: var(--shadow-sm);
        }

        .card-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0 0 0.5rem;
        }

        .card-meta {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin: 0.28rem 0;
        }

        .card-meta + .card-meta { margin-top: 0.15rem; }

        .badge {
            display: inline-block;
            padding: 0.24rem 0.62rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .badge-pendente { background: var(--warning-bg); color: #854d0e; }
        .badge-responsavel { background: var(--info-bg); color: var(--info); }
        .badge-professor { background: #f3e8ff; color: #6b21a8; }
        .badge-liberado { background: var(--success-bg); color: #166534; }

        .card-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1rem 0;
        }

        .final-msg {
            color: var(--success);
            font-weight: 700;
            text-align: center;
            padding: 0.5rem 0;
        }

        .empty-state {
            text-align: center;
            padding: 2.75rem 1.5rem;
            background: var(--surface);
            border: 1px dashed var(--border);
            border-radius: var(--radius-lg);
            color: var(--text-muted);
            box-shadow: var(--shadow-sm);
        }

        .form-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .form-group { margin-bottom: 1.1rem; }

        .form-group label {
            display: block;
            margin-bottom: 0.42rem;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 0.72rem 0.9rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.92rem;
            font-family: inherit;
            background: var(--surface-muted);
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
        }

        .form-error {
            color: var(--danger);
            font-size: 0.82rem;
            margin-top: 0.32rem;
        }

        .dashboard-links {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }

        .dashboard-link-card {
            display: block;
            text-decoration: none;
            color: inherit;
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: 1.15rem 1.2rem 1.15rem 1.35rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            border-left: 3px solid var(--primary);
            transition: border-color 0.15s, box-shadow 0.15s, transform 0.15s;
        }

        .dashboard-link-card:hover {
            border-color: #f5b4b8;
            box-shadow: var(--shadow);
            transform: translateY(-2px);
        }

        .dashboard-link-card strong {
            display: block;
            margin-bottom: 0.35rem;
            font-size: 0.98rem;
            font-weight: 700;
        }

        .dashboard-link-card span {
            color: var(--text-muted);
            font-size: 0.87rem;
            line-height: 1.45;
        }

        .stats-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: 1rem 1.1rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            border-top: 3px solid var(--primary);
        }

        .stat-card span {
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .stat-card strong {
            display: block;
            font-size: 1.65rem;
            font-weight: 700;
            margin-top: 0.35rem;
            letter-spacing: -0.02em;
        }

        .aulas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 0.6rem;
        }

        .aula-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--surface-muted);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.6rem 0.7rem;
            cursor: pointer;
            font-size: 0.88rem;
        }

        .aula-check:has(input:checked) {
            border-color: #f5a8ad;
            background: var(--primary-soft);
        }

        .table-wrap {
            overflow-x: auto;
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        .table-wrap th,
        .table-wrap td {
            padding: 0.85rem 1rem;
            text-align: left;
            border-bottom: none;
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .table-wrap thead tr {
            background: var(--surface-muted);
            box-shadow: inset 0 -1px 0 var(--border);
        }

        .table-wrap tbody tr:not(:last-child) {
            box-shadow: inset 0 -1px 0 var(--border);
        }

        .table-wrap th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            font-weight: 600;
        }

        .table-wrap tbody tr:hover {
            background: #fafbfc;
        }

        .notif-item {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1rem 1.1rem;
            margin-bottom: 0.75rem;
            box-shadow: var(--shadow-sm);
        }

        .notif-item.nao-lida {
            border-left: 4px solid var(--primary);
            background: linear-gradient(90deg, var(--primary-soft) 0%, white 12%);
        }

        .notif-item.lida { opacity: 0.82; }

        .badge-status {
            display: inline-block;
            padding: 0.22rem 0.58rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .toolbar--page-head {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .form-row-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 600px) {
            .form-row-grid { grid-template-columns: 1fr; }
        }

        .hint-text {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin: 0.25rem 0 0.5rem;
        }

        .info-inline {
            padding: 0.85rem 1rem;
            background: var(--surface-muted);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        .info-inline a { color: var(--primary); font-weight: 600; }

        .badge-tipo {
            display: inline-block;
            padding: 0.22rem 0.55rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .badge-tipo--cai { background: #ede9fe; color: #5b21b6; }
        .badge-tipo--tecnico { background: #dbeafe; color: #1e40af; }
        .badge-tipo--fic { background: #ffedd5; color: #c2410c; }

        .chip-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
        }

        .chip {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            background: var(--surface-muted);
            border: 1px solid var(--border);
            border-radius: 999px;
            font-size: 0.78rem;
            color: var(--text);
        }

        .professor-picker {
            display: grid;
            gap: 0.5rem;
            max-height: 220px;
            overflow-y: auto;
            padding: 0.65rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--surface-muted);
        }

        .professor-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.55rem;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.88rem;
        }

        .professor-option:has(input:checked) {
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        .card--elevated {
            border-left: 3px solid var(--primary);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 0.35rem;
        }

        .table-actions-head,
        .table-actions {
            text-align: right;
            white-space: nowrap;
            width: 1%;
            min-width: 13rem;
            padding-left: 1.25rem;
        }

        .table-actions-inner {
            display: inline-flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-table {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.45rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 600;
            line-height: 1.2;
            border-radius: 8px;
            border: 1px solid transparent;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s, border-color 0.15s, color 0.15s, box-shadow 0.15s, transform 0.15s;
            box-shadow: var(--shadow-sm);
        }

        .btn-table:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }

        .btn-table-edit {
            background: var(--surface);
            border-color: var(--border);
            color: var(--text);
        }

        .btn-table-edit:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-soft);
        }

        .btn-table-delete {
            background: var(--danger-bg);
            border-color: #fecaca;
            color: var(--danger);
        }

        .btn-table-delete:hover {
            background: #fee2e2;
            border-color: var(--danger);
        }

        .table-actions .inline-form {
            display: inline-flex;
            margin: 0;
        }

        .inline-form { display: inline-block; }

        .btn-block-spaced { width: 100%; margin-top: 0.75rem; }

        .text-muted { color: var(--text-muted); }

        .table-wrap table a:not(.btn-table) {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .table-wrap table a:not(.btn-table):hover { text-decoration: underline; }
    </style>
    @stack('styles')
</head>
<body>
    <header class="app-header">
        <div class="app-header-inner">
            @php
                $inicioRoute = auth()->check() ? \App\Support\UserRole::dashboardRoute(auth()->user()->role) : null;
            @endphp
            <a href="{{ $inicioRoute ? route($inicioRoute) : url('/') }}" class="brand">
                <x-senai-logo size="md" class="brand-logo" />
            </a>
            @auth
                <div class="header-actions">
                    <span class="user-pill">{{ auth()->user()->name }} · {{ auth()->user()->cargoLabel() }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-ghost">Sair</button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    <main class="app-main">
        @auth
            <nav class="app-nav" aria-label="Menu principal">
                @if (in_array(auth()->user()->role, \App\Support\UserRole::AQV_ALIASES, true))
                    <a href="{{ route('aqv.dashboard') }}" @class(['active' => request()->routeIs('aqv.dashboard', 'home')])>Início</a>
                    <a href="{{ route('usuarios.index') }}" @class(['active' => request()->routeIs('usuarios.*')])>Equipe</a>
                    <a href="{{ route('cursos.index') }}" @class(['active' => request()->routeIs('cursos.*')])>Cursos</a>
                    <a href="{{ route('alunos.index') }}" @class(['active' => request()->routeIs('alunos.*')])>Alunos</a>
                    <a href="{{ route('solicitacoes.index') }}" @class(['active' => request()->routeIs('solicitacoes.*', 'cards.*')])>Solicitações</a>
                @elseif (auth()->user()->role === 'professor')
                    <a href="{{ route('professor.dashboard') }}" @class(['active' => request()->routeIs('professor.dashboard')])>Notificações</a>
                @elseif (auth()->user()->role === 'portaria')
                    <a href="{{ route('portaria.dashboard') }}" @class(['active' => request()->routeIs('portaria.dashboard')])>Portaria</a>
                @endif
            </nav>
        @endauth

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
    <script src="{{ asset('js/safe-masks.js') }}"></script>
    @stack('scripts')
</body>
</html>
