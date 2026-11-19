<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SENAI — Sistema de Controle de Acesso')</title>
    <link rel="icon" href="{{ \App\Support\SenaiBrand::faviconUrl() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0d0d0d;
            --bg-panel: #161616;
            --text: #ffffff;
            --muted: #9ca3af;
            --primary: #e30613;
            --primary-dark: #c10510;
            --primary-glow: rgba(227, 6, 19, 0.35);
            --radius: 10px;
            --radius-lg: 16px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(24px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes slideRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(12px, -18px) scale(1.05); }
        }

        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.85); }
        }

        body {
            font-family: "Inter", "Segoe UI", system-ui, sans-serif;
            color: var(--text);
            min-height: 100vh;
            background: var(--bg);
            -webkit-font-smoothing: antialiased;
        }

        .login-layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr;
        }

        @media (min-width: 960px) {
            .login-layout { grid-template-columns: 1.15fr 1fr; }
        }

        .login-brand {
            position: relative;
            padding: 2rem 1.5rem 2.5rem;
            display: flex;
            flex-direction: column;
            background:
                radial-gradient(ellipse 90% 60% at 10% 0%, var(--primary-glow), transparent 50%),
                radial-gradient(ellipse 50% 40% at 100% 100%, rgba(255,255,255,0.04), transparent 45%),
                var(--bg);
            overflow: hidden;
        }

        @media (min-width: 960px) {
            .login-brand {
                padding: 2.5rem 3rem;
                min-height: 100vh;
            }
        }

        .login-brand::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            right: -60px;
            bottom: 20%;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2), transparent 68%);
            border-radius: 50%;
            animation: float 9s ease-in-out infinite;
            pointer-events: none;
        }

        @media (min-width: 960px) {
            .login-brand::before {
                content: "";
                position: absolute;
                right: 0;
                top: 12%;
                bottom: 12%;
                width: 1px;
                background: linear-gradient(180deg, transparent, rgba(255,255,255,0.1), transparent);
            }
        }

        .brand-top {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
            color: inherit;
            margin-bottom: 2.5rem;
            animation: fadeUp 0.5s ease backwards;
        }

        .senai-logo-img {
            width: auto;
            display: block;
            object-fit: contain;
        }

        .brand-top .senai-logo-img {
            transition: transform 0.25s ease;
        }

        .brand-top:hover .senai-logo-img { transform: scale(1.04); }

        .brand-top-text strong {
            display: block;
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: 0.06em;
        }

        .brand-top-text span {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .brand-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 480px;
        }

        .brand-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #fca5a5;
            margin-bottom: 1rem;
            padding: 0.35rem 0.65rem;
            background: rgba(227, 6, 19, 0.12);
            border: 1px solid rgba(227, 6, 19, 0.25);
            border-radius: 999px;
            width: fit-content;
            animation: fadeUp 0.55s ease 0.08s backwards;
        }

        .brand-eyebrow::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--primary);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        .brand-content h1 {
            font-size: clamp(1.85rem, 4vw, 2.5rem);
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
            animation: fadeUp 0.6s ease 0.15s backwards;
        }

        .brand-content > .brand-lead {
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.65;
            margin-bottom: 2rem;
            animation: fadeUp 0.6s ease 0.22s backwards;
        }

        .brand-steps {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .brand-step {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            padding: 0.85rem 1rem;
            background: var(--bg-panel);
            border: 1px solid #2a2a2a;
            border-radius: var(--radius);
            transition: transform 0.25s ease, border-color 0.25s ease, background 0.25s ease;
            animation: fadeUp 0.55s ease backwards;
        }

        .brand-step:nth-child(1) { animation-delay: 0.32s; }
        .brand-step:nth-child(2) { animation-delay: 0.42s; }
        .brand-step:nth-child(3) { animation-delay: 0.52s; }

        .brand-step:hover {
            transform: translateX(6px);
            border-color: rgba(227, 6, 19, 0.35);
            background: #1a1a1a;
        }

        .brand-step-num {
            flex-shrink: 0;
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 8px;
            background: var(--primary);
            color: white;
            font-size: 0.78rem;
            font-weight: 700;
            display: grid;
            place-items: center;
        }

        .brand-step h3 {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.15rem;
        }

        .brand-step p {
            font-size: 0.82rem;
            color: var(--muted);
            line-height: 1.4;
        }

        .brand-footer {
            margin-top: 2rem;
            font-size: 0.75rem;
            color: #6b7280;
            animation: fadeIn 0.8s ease 0.6s backwards;
        }

        @media (max-width: 959px) {
            .brand-steps { display: none; }
            .brand-content h1 { font-size: 1.5rem; }
            .brand-content > .brand-lead { margin-bottom: 0; font-size: 0.92rem; }
        }

        .login-side {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.25rem 2.5rem;
            background: #f4f5f7;
        }

        @media (min-width: 960px) {
            .login-side {
                padding: 2.5rem;
                min-height: 100vh;
            }
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: var(--radius-lg);
            box-shadow:
                0 1px 2px rgba(16, 24, 40, 0.04),
                0 12px 40px rgba(16, 24, 40, 0.1);
            border: 1px solid #e8eaed;
            overflow: hidden;
            animation: cardIn 0.65s cubic-bezier(0.22, 1, 0.36, 1) 0.12s backwards;
        }

        .login-card-header {
            padding: 1.75rem 1.75rem 1.25rem;
            text-align: center;
            background: linear-gradient(180deg, #fff 0%, #fafbfc 100%);
            border-bottom: 1px solid #f0f1f3;
            animation: slideRight 0.5s ease 0.25s backwards;
        }

        .login-card-header h2 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #111827;
            letter-spacing: -0.02em;
            margin-bottom: 0.3rem;
        }

        .login-card-header p {
            font-size: 0.88rem;
            color: #6b7280;
        }

        .login-card-body {
            padding: 1.5rem 1.75rem 1.75rem;
            animation: fadeIn 0.5s ease 0.35s backwards;
        }

        .tabs {
            display: flex;
            gap: 0.35rem;
            background: #f3f4f6;
            padding: 0.35rem;
            border-radius: 10px;
            margin-bottom: 1.35rem;
        }

        .tab {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0.6rem 0.75rem;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.84rem;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .tab.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        }

        .panel { display: none; }
        .panel.active {
            display: block;
            animation: panelIn 0.35s ease;
        }

        @keyframes panelIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .panel-title {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .panel-subtitle {
            font-size: 0.84rem;
            color: #6b7280;
            margin-bottom: 1.25rem;
            line-height: 1.5;
        }

        .form-group { margin-bottom: 1.1rem; }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }

        .input-wrap { position: relative; }

        .input-wrap > svg.field-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.1rem;
            height: 1.1rem;
            color: #9ca3af;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-control {
            width: 100%;
            padding: 0.78rem 0.9rem 0.78rem 2.65rem;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.92rem;
            background: #f9fafb;
            color: #111827;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-control::placeholder { color: #9ca3af; }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(227, 6, 19, 0.1);
        }

        .input-wrap:focus-within > svg.field-icon { color: var(--primary); }

        .input-wrap--password .form-control { padding-right: 2.75rem; }

        .toggle-password {
            position: absolute;
            right: 0.65rem;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            padding: 0.35rem;
            cursor: pointer;
            color: #9ca3af;
            display: flex;
            border-radius: 6px;
            transition: color 0.2s, background 0.2s;
        }

        .toggle-password:hover { color: #374151; background: #f3f4f6; }
        .toggle-password svg { width: 1.15rem; height: 1.15rem; }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.84rem;
            color: #4b5563;
            cursor: pointer;
        }

        .remember input { width: 1rem; height: 1rem; accent-color: var(--primary); }

        .link-muted {
            font-size: 0.84rem;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .link-muted:hover { text-decoration: underline; opacity: 0.85; }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.84rem;
            font-weight: 600;
            color: #6b7280;
            text-decoration: none;
            margin-bottom: 1.15rem;
            transition: color 0.2s, gap 0.2s;
        }

        .back-link:hover { color: var(--primary); gap: 0.5rem; }

        .back-link svg { width: 1rem; height: 1rem; }

        .btn {
            display: block;
            width: 100%;
            padding: 0.82rem 1rem;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 12px rgba(227, 6, 19, 0.35);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(227, 6, 19, 0.4);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #111827;
            margin-top: 0.85rem;
        }

        .btn-secondary:hover { background: #e5e7eb; }

        .alert {
            padding: 0.75rem 0.9rem;
            border-radius: 10px;
            font-size: 0.86rem;
            margin-bottom: 1.15rem;
            line-height: 1.45;
            animation: fadeUp 0.35s ease;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .access-list { list-style: none; }

        .access-item {
            display: flex;
            gap: 0.85rem;
            padding: 0.85rem 0;
            border-bottom: 1px solid #f3f4f6;
            transition: transform 0.2s ease;
            animation: fadeUp 0.4s ease backwards;
        }

        .access-item:nth-child(1) { animation-delay: 0.05s; }
        .access-item:nth-child(2) { animation-delay: 0.12s; }
        .access-item:nth-child(3) { animation-delay: 0.19s; }

        .access-item:hover { transform: translateX(4px); }
        .access-item:last-child { border-bottom: none; }

        .access-icon {
            flex-shrink: 0;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 8px;
            background: #fef2f2;
            color: var(--primary);
            display: grid;
            place-items: center;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .access-item strong {
            display: block;
            font-size: 0.88rem;
            color: #111827;
            margin-bottom: 0.15rem;
        }

        .access-item span {
            font-size: 0.82rem;
            color: #6b7280;
            line-height: 1.45;
        }

        .info-box {
            display: flex;
            gap: 0.75rem;
            padding: 0.9rem 1rem;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.86rem;
            color: #4b5563;
            line-height: 1.5;
            animation: fadeUp 0.4s ease 0.1s backwards;
        }

        .info-box svg {
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            color: var(--primary);
            margin-top: 0.1rem;
        }

        .login-side-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.78rem;
            color: #9ca3af;
            max-width: 400px;
            animation: fadeIn 0.6s ease 0.5s backwards;
        }

        .logged-box {
            text-align: center;
            padding: 1rem 0;
        }

        .logged-box p {
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 1rem;
        }

        .logged-box strong { color: #111827; }

        .logged-box .btn-primary {
            max-width: 220px;
            margin: 0 auto;
            text-decoration: none;
        }

        @media (max-width: 959px) {
            .login-brand { padding-bottom: 1.25rem; }
            .brand-top { margin-bottom: 1.25rem; }
            .login-side {
                padding-top: 0;
                margin-top: -0.5rem;
                border-radius: 20px 20px 0 0;
            }
        }

        @stack('styles')
    </style>
</head>
<body>
    <div class="login-layout">
        <aside class="login-brand">
            <a href="{{ url('/') }}" class="brand-top">
                <x-senai-logo size="lg" />
                <div class="brand-top-text">
                    <strong>SENAI</strong>
                    <span>Controle de Acesso</span>
                </div>
            </a>

            <div class="brand-content">
                @hasSection('brand-eyebrow')
                    <span class="brand-eyebrow">@yield('brand-eyebrow')</span>
                @else
                    <span class="brand-eyebrow">Sistema institucional</span>
                @endif

                <h1>@yield('brand-title', 'Gestão segura de saídas e acessos')</h1>
                <p class="brand-lead">@yield('brand-lead', 'Cadastro, autorização e liberação em um único fluxo para AQV, professores e porteiros.')</p>

                @hasSection('brand-extra')
                    @yield('brand-extra')
                @else
                    <div class="brand-steps">
                        <div class="brand-step">
                            <span class="brand-step-num">1</span>
                            <div>
                                <h3>AQV</h3>
                                <p>Cadastra cursos, alunos e solicitações de saída.</p>
                            </div>
                        </div>
                        <div class="brand-step">
                            <span class="brand-step-num">2</span>
                            <div>
                                <h3>Professores</h3>
                                <p>Recebem aviso quando um aluno do curso vai sair.</p>
                            </div>
                        </div>
                        <div class="brand-step">
                            <span class="brand-step-num">3</span>
                            <div>
                                <h3>Porteiro</h3>
                                <p>Libera a saída com registro validado no sistema.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <p class="brand-footer">© {{ date('Y') }} SENAI — Sistema de Controle de Acesso</p>
        </aside>

        <section class="login-side">
            <div class="login-card">
                <div class="login-card-header">
                    <h2>@yield('card-title')</h2>
                    <p>@yield('card-subtitle')</p>
                </div>
                <div class="login-card-body">
                    @yield('content')
                </div>
            </div>
            <p class="login-side-footer">@yield('side-footer', 'Em caso de dúvida, procure a secretaria ou o AQV.')</p>
        </section>
    </div>

    @stack('scripts')
</body>
</html>
