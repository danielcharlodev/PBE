<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFE — Sistema de Portaria Escolar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0b1220;
            --bg-card: rgba(255, 255, 255, 0.06);
            --border: rgba(255, 255, 255, 0.12);
            --text: #f8fafc;
            --muted: #94a3b8;
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --accent: #22c55e;
            --radius: 16px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Plus Jakarta Sans", system-ui, sans-serif;
            color: var(--text);
            min-height: 100vh;
            background:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(59, 130, 246, 0.35), transparent),
                radial-gradient(ellipse 60% 40% at 90% 10%, rgba(34, 197, 94, 0.15), transparent),
                var(--bg);
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            color: inherit;
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            display: grid;
            place-items: center;
            font-size: 1.35rem;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
        }

        .logo strong { display: block; font-size: 1.1rem; letter-spacing: 0.04em; }
        .logo span { font-size: 0.75rem; color: var(--muted); }

        .main {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 1.25rem 2.5rem;
            width: 100%;
            align-items: center;
        }

        @media (min-width: 900px) {
            .main {
                grid-template-columns: 1.1fr 0.9fr;
                padding: 2rem 1.5rem 3rem;
            }
        }

        .hero h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.65;
            max-width: 520px;
            margin-bottom: 1.75rem;
        }

        .features {
            display: grid;
            gap: 0.85rem;
        }

        @media (min-width: 500px) {
            .features { grid-template-columns: 1fr 1fr; }
        }

        .feature {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem 1.1rem;
            backdrop-filter: blur(8px);
        }

        .feature-icon { font-size: 1.4rem; margin-bottom: 0.35rem; }
        .feature h3 { font-size: 0.92rem; font-weight: 700; margin-bottom: 0.2rem; }
        .feature p { font-size: 0.8rem; color: var(--muted); line-height: 1.45; }

        .auth-panel {
            background: rgba(255, 255, 255, 0.97);
            color: #0f172a;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @media (min-width: 900px) {
            .auth-panel { padding: 2rem; }
        }

        .tabs {
            display: flex;
            gap: 0.35rem;
            background: #f1f5f9;
            padding: 0.35rem;
            border-radius: 12px;
            margin-bottom: 1.25rem;
        }

        .tab {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0.65rem 0.75rem;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s;
        }

        .tab.active {
            background: white;
            color: #1e40af;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
        }

        .panel { display: none; }
        .panel.active { display: block; }

        .auth-panel h2 {
            font-size: 1.35rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .auth-panel .subtitle {
            color: #64748b;
            font-size: 0.88rem;
            margin-bottom: 1.25rem;
        }

        .form-group { margin-bottom: 1rem; }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.4rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.95rem;
            background: #f8fafc;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control:focus {
            outline: none;
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            background: white;
        }

        .form-error {
            color: #dc2626;
            font-size: 0.82rem;
            margin-top: 0.35rem;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 0.75rem 0.9rem;
            border-radius: 10px;
            font-size: 0.88rem;
            margin-bottom: 1rem;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 1rem;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 0.85rem 1rem;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.45);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #1e40af;
            margin-top: 0.75rem;
        }

        .btn-secondary:hover { background: #e2e8f0; }

        .auth-footer {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.8rem;
            color: #64748b;
        }

        .auth-footer a { color: #2563eb; font-weight: 600; text-decoration: none; }

        .access-list {
            list-style: none;
            margin: 1rem 0;
        }

        .access-list li {
            display: flex;
            gap: 0.65rem;
            padding: 0.65rem 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.88rem;
            color: #475569;
            line-height: 1.45;
        }

        .access-list li:last-child { border-bottom: none; }

        .access-list .icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: #eff6ff;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            font-size: 0.9rem;
        }

        .role-badge {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            font-size: 0.72rem;
            font-weight: 700;
            background: #dbeafe;
            color: #1e40af;
            margin-right: 0.25rem;
        }

        .footer {
            text-align: center;
            padding: 1rem;
            font-size: 0.78rem;
            color: var(--muted);
        }

        @auth
        .logged-bar {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-size: 0.88rem;
        }
        .logged-bar a { color: #4ade80; font-weight: 700; }
        @endauth
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <a href="{{ url('/') }}" class="logo">
                <div class="logo-icon">🚪</div>
                <div>
                    <strong>SAFE</strong>
                    <span>Portaria Escolar</span>
                </div>
            </a>
            @auth
                <a href="{{ route('home') }}" class="btn btn-primary" style="width:auto;padding:0.55rem 1.1rem;font-size:0.85rem;">Ir para o painel</a>
            @endauth
        </header>

        <main class="main">
            <section class="hero">
                <h1>Controle inteligente de saídas escolares</h1>
                <p>
                    O SAFE conecta direção, professores e portaria em um fluxo seguro:
                    cadastro de alunos, autorização de saída, notificações e liberação no portão.
                </p>

                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">👨‍💼</div>
                        <h3>Direção</h3>
                        <p>Cadastra alunos, equipe e cria cards de saída com registro de faltas.</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">👨‍🏫</div>
                        <h3>Professores</h3>
                        <p>Recebem aviso automático quando um aluno do seu curso vai sair.</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🛡️</div>
                        <h3>Portaria</h3>
                        <p>Libera no portão somente alunos com card autorizado pela diretoria.</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">✅</div>
                        <h3>Segurança</h3>
                        <p>Fluxo rastreável do responsável até a liberação na portaria.</p>
                    </div>
                </div>
            </section>

            <section class="auth-panel" id="acesso">
                @auth
                    <div class="logged-bar">
                        Você já está conectado como <strong>{{ auth()->user()->name }}</strong>.
                        <a href="{{ route('home') }}">Acessar painel →</a>
                    </div>
                @else
                    <div class="tabs" role="tablist">
                        <button type="button" class="tab active" data-tab="login" role="tab">Entrar</button>
                        <button type="button" class="tab" data-tab="acesso-info" role="tab">Como obter acesso</button>
                    </div>

                    <div id="panel-login" class="panel active" role="tabpanel">
                        <h2>Bem-vindo de volta</h2>
                        <p class="subtitle">Use o e-mail e a senha fornecidos pela escola.</p>

                        @if ($errors->any())
                            <div class="alert-error">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (session('status'))
                            <div class="alert-error" style="background:#f0fdf4;border-color:#bbf7d0;color:#166534;">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input id="email" type="email" name="email" class="form-control"
                                    value="{{ old('email') }}" required autofocus autocomplete="username"
                                    placeholder="seu@email.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input id="password" type="password" name="password" class="form-control"
                                    required autocomplete="current-password" placeholder="••••••••">
                            </div>
                            <label class="remember">
                                <input type="checkbox" name="remember">
                                Lembrar de mim
                            </label>
                            <button type="submit" class="btn btn-primary">Entrar no sistema</button>
                        </form>

                        @if (Route::has('password.request'))
                            <p class="auth-footer">
                                <a href="{{ route('password.request') }}">Esqueci minha senha</a>
                            </p>
                        @endif
                    </div>

                    <div id="panel-acesso-info" class="panel" role="tabpanel">
                        <h2>Como obter acesso</h2>
                        <p class="subtitle">O cadastro no SAFE é feito pela direção escolar.</p>

                        <ul class="access-list">
                            <li>
                                <span class="icon">👨‍💼</span>
                                <span>
                                    <span class="role-badge">Diretor</span>
                                    Recebe login na implantação do sistema (conta principal da escola).
                                </span>
                            </li>
                            <li>
                                <span class="icon">👨‍🏫</span>
                                <span>
                                    <span class="role-badge">Professor</span>
                                    A direção cadastra em <strong>Equipe</strong> e informa e-mail e senha.
                                </span>
                            </li>
                            <li>
                                <span class="icon">🛡️</span>
                                <span>
                                    <span class="role-badge">Portaria</span>
                                    Mesmo processo: cadastro feito pelo diretor com matrícula e setor.
                                </span>
                            </li>
                        </ul>

                        <button type="button" class="btn btn-secondary" data-tab-trigger="login">
                            Já tenho login → Entrar
                        </button>
                    </div>
                @endauth
            </section>
        </main>

        <footer class="footer">
            © {{ date('Y') }} SAFE — Sistema de Autorização da Portaria Escolar
        </footer>
    </div>

    <script>
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => ativarTab(tab.dataset.tab));
        });
        document.querySelectorAll('[data-tab-trigger]').forEach(btn => {
            btn.addEventListener('click', () => ativarTab(btn.dataset.tabTrigger));
        });

        function ativarTab(nome) {
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.toggle('active', t.dataset.tab === nome);
            });
            document.querySelectorAll('.panel').forEach(p => {
                p.classList.toggle('active', p.id === 'panel-' + nome);
            });
        }

        const params = new URLSearchParams(window.location.search);
        if (params.get('tab') === 'acesso') ativarTab('acesso-info');
    </script>
</body>
</html>
