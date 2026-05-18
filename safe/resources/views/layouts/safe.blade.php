<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SAFE - Portaria Escolar')</title>
    <style>
        :root {
            --bg: #0f172a;
            --bg-soft: #1e293b;
            --surface: #ffffff;
            --surface-muted: #f8fafc;
            --border: #e2e8f0;
            --text: #0f172a;
            --text-muted: #64748b;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --success: #16a34a;
            --success-bg: #dcfce7;
            --warning: #ca8a04;
            --warning-bg: #fef9c3;
            --danger: #dc2626;
            --danger-bg: #fee2e2;
            --info-bg: #dbeafe;
            --info: #1e40af;
            --purple-bg: #ede9fe;
            --purple: #5b21b6;
            --radius: 14px;
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            --shadow-hover: 0 16px 40px rgba(15, 23, 42, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.12), transparent 28%),
                radial-gradient(circle at top right, rgba(22, 163, 74, 0.08), transparent 24%),
                linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
            min-height: 100vh;
        }

        .safe-header {
            background: linear-gradient(135deg, var(--bg) 0%, #1e3a8a 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.18);
        }

        .safe-header-inner {
            max-width: 960px;
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
            gap: 0.75rem;
            text-decoration: none;
            color: inherit;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, 0.12);
            font-size: 1.25rem;
        }

        .brand h1 {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .brand p {
            margin: 0.15rem 0 0;
            font-size: 0.82rem;
            opacity: 0.82;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .user-pill {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.14);
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-size: 0.85rem;
        }

        .safe-main {
            max-width: 960px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
        }

        .page-title {
            margin: 0;
            font-size: 1.5rem;
            color: var(--text);
        }

        .page-subtitle {
            margin: 0.35rem 0 0;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            border: none;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.92rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .btn:hover { transform: translateY(-1px); }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover { background: var(--primary-hover); }

        .btn-secondary {
            background: white;
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--surface-muted);
            box-shadow: var(--shadow);
        }

        .btn-action {
            background: var(--primary);
            color: white;
            width: 100%;
        }

        .btn-action:hover { background: var(--primary-hover); }

        .alert {
            padding: 0.9rem 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            font-size: 0.92rem;
            border: 1px solid transparent;
        }

        .alert-success {
            background: var(--success-bg);
            color: #14532d;
            border-color: #86efac;
        }

        .alert-error {
            background: var(--danger-bg);
            color: #7f1d1d;
            border-color: #fca5a5;
        }

        .card {
            background: var(--surface);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: var(--radius);
            padding: 1.15rem 1.2rem;
            margin-bottom: 1rem;
            box-shadow: var(--shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            animation: fadeIn 0.35s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 0.5rem;
        }

        .card-meta {
            color: var(--text-muted);
            font-size: 0.92rem;
            margin: 0.35rem 0;
        }

        .badge {
            display: inline-block;
            padding: 0.28rem 0.7rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .badge-pendente { background: var(--warning-bg); color: #854d0e; }
        .badge-responsavel { background: var(--info-bg); color: var(--info); }
        .badge-professor { background: var(--purple-bg); color: var(--purple); }
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
            padding: 3rem 1.5rem;
            background: rgba(255, 255, 255, 0.75);
            border: 1px dashed var(--border);
            border-radius: var(--radius);
            color: var(--text-muted);
        }

        .form-card {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .form-group { margin-bottom: 1.1rem; }

        .form-group label {
            display: block;
            margin-bottom: 0.45rem;
            font-weight: 600;
            font-size: 0.92rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            background: var(--surface-muted);
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
            background: white;
        }

        .form-error {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.35rem;
        }

        .dashboard-links {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .dashboard-link-card {
            display: block;
            text-decoration: none;
            color: inherit;
            background: white;
            border-radius: var(--radius);
            padding: 1.25rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .dashboard-link-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .dashboard-link-card strong {
            display: block;
            margin-bottom: 0.35rem;
            font-size: 1rem;
        }

        .dashboard-link-card span {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text);
            background: white;
            border: 1px solid var(--border);
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .stats-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            margin-bottom: 1.25rem;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius);
            padding: 1rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .stat-card strong {
            display: block;
            font-size: 1.6rem;
            margin-top: 0.25rem;
        }

        .stat-card span { color: var(--text-muted); font-size: 0.85rem; }

        .aulas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.65rem;
        }

        .aula-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--surface-muted);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.65rem 0.75rem;
            cursor: pointer;
        }

        .aula-check:has(input:checked) {
            border-color: #93c5fd;
            background: #eff6ff;
        }

        .table-wrap {
            overflow-x: auto;
            background: white;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.85rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 0.92rem;
        }

        th {
            background: var(--surface-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--text-muted);
        }

        tr:last-child td { border-bottom: none; }

        .notif-item {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1rem;
            margin-bottom: 0.75rem;
            box-shadow: var(--shadow);
        }

        .notif-item.nao-lida {
            border-left: 4px solid var(--primary);
        }

        .notif-item.lida { opacity: 0.75; }

        .badge-status {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-pendente { background: var(--warning-bg); color: #854d0e; }
        .badge-liberado { background: var(--success-bg); color: #166534; }
    </style>
    @stack('styles')
</head>
<body>
    <header class="safe-header">
        <div class="safe-header-inner">
            <a href="{{ auth()->check() ? route('home') : url('/') }}" class="brand">
                <div class="brand-icon">🚪</div>
                <div>
                    <h1>SAFE</h1>
                    <p>Sistema de Autorização da Portaria Escolar</p>
                </div>
            </a>
            @auth
                <div class="header-actions">
                    <span class="user-pill">{{ auth()->user()->name }} · {{ ucfirst(auth()->user()->role) }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Sair</button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    <main class="safe-main">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @auth
            <nav class="nav-links">
                @if (auth()->user()->role === 'diretor')
                    <a href="{{ route('diretor.dashboard') }}">Início</a>
                    <a href="{{ route('alunos.index') }}">Alunos</a>
                    <a href="{{ route('usuarios.index') }}">Equipe</a>
                    <a href="{{ route('cards.index') }}">Cards de saída</a>
                @elseif (auth()->user()->role === 'professor')
                    <a href="{{ route('professor.dashboard') }}">Notificações</a>
                @elseif (auth()->user()->role === 'portaria')
                    <a href="{{ route('portaria.dashboard') }}">Portaria</a>
                @endif
            </nav>
        @endauth

        @yield('content')
    </main>
    <script src="{{ asset('js/safe-masks.js') }}"></script>
    @stack('scripts')
</body>
</html>
