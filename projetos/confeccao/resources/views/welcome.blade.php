<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistema Laravel') }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #eff6ff, #f8fafc, #eef2ff);
            color: #1f2937;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 28px 0;
            flex-wrap: wrap;
            gap: 16px;
        }

        .logo {
            font-size: 28px;
            font-weight: 900;
            color: #111827;
            letter-spacing: 1px;
        }

        .logo span {
            color: #2563eb;
        }

        .nav-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            border-radius: 999px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.25s ease;
            border: none;
            cursor: pointer;
        }

        .btn-outline {
            background: white;
            color: #1f2937;
            border: 1px solid #d1d5db;
            box-shadow: 0 8px 18px rgba(0,0,0,0.06);
        }

        .btn-outline:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 24px rgba(0,0,0,0.10);
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            box-shadow: 0 10px 20px rgba(37,99,235,0.25);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 28px rgba(37,99,235,0.35);
        }

        .hero {
            padding: 50px 0 30px;
        }

        .hero-box {
            background: white;
            border-radius: 32px;
            padding: 60px 40px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.08);
            border: 1px solid #e5e7eb;
            text-align: center;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 10px 18px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: 54px;
            line-height: 1.1;
            font-weight: 900;
            color: #111827;
            margin-bottom: 18px;
        }

        .hero p {
            max-width: 760px;
            margin: 0 auto 28px auto;
            font-size: 18px;
            color: #6b7280;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 36px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 24px;
        }

        .mini-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            padding: 24px 18px;
            text-align: center;
            transition: 0.25s ease;
        }

        .mini-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 28px rgba(0,0,0,0.08);
        }

        .mini-card .icon {
            font-size: 34px;
            margin-bottom: 12px;
        }

        .mini-card h3 {
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 8px;
            color: #111827;
        }

        .mini-card p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
        }

        .section {
            padding: 20px 0 70px;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            font-weight: 900;
            color: #111827;
            margin-bottom: 12px;
        }

        .section-subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 17px;
            margin-bottom: 34px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 30px 24px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.07);
            border: 1px solid #e5e7eb;
            transition: 0.25s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 38px rgba(0,0,0,0.12);
        }

        .card .icon {
            font-size: 38px;
            margin-bottom: 14px;
        }

        .card h3 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 10px;
            color: #111827;
        }

        .card p {
            color: #6b7280;
            line-height: 1.7;
            font-size: 15px;
        }

        .footer {
            padding: 24px 0 40px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        @media (max-width: 1024px) {
            .hero-grid,
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero h1 {
                font-size: 42px;
            }
        }

        @media (max-width: 640px) {
            .hero-box {
                padding: 38px 22px;
            }

            .hero h1 {
                font-size: 34px;
            }

            .hero p {
                font-size: 16px;
            }

            .hero-grid,
            .cards {
                grid-template-columns: 1fr;
            }

            .topbar {
                justify-content: center;
            }

            .logo {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="topbar">
            <div class="logo">
                <span>{{ config('app.name', 'Meu') }}</span> Sistema
            </div>

            @if (Route::has('login'))
                <nav class="nav-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            Ir para o Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">
                            Entrar
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Criar Conta
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <section class="hero">
            <div class="hero-box">
                <div class="badge">
                    Sistema de gestão moderno
                </div>

                <h1>
                    Organize clientes, estoque,<br>
                    produtos, fornecedores e pedidos
                </h1>

                <p>
                    Uma plataforma completa para gerenciar o seu negócio com mais agilidade,
                    visual profissional e informações organizadas em um só lugar.
                </p>

                <div class="hero-actions">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            Acessar painel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            Começar agora
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline">
                                Registrar conta
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="hero-grid">
                    <div class="mini-card">
                        <div class="icon">👥</div>
                        <h3>Clientes</h3>
                        <p>Cadastro e gerenciamento completo de clientes.</p>
                    </div>

                    <div class="mini-card">
                        <div class="icon">📦</div>
                        <h3>Produtos</h3>
                        <p>Controle visual dos produtos disponíveis.</p>
                    </div>

                    <div class="mini-card">
                        <div class="icon">🏪</div>
                        <h3>Estoque</h3>
                        <p>Acompanhe quantidade, reserva e disponibilidade.</p>
                    </div>

                    <div class="mini-card">
                        <div class="icon">🧾</div>
                        <h3>Pedidos</h3>
                        <p>Pedidos organizados com status e histórico.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">O que você pode fazer</h2>
            <p class="section-subtitle">
                Tudo o que seu sistema precisa para funcionar de forma clara e profissional.
            </p>

            <div class="cards">
                <div class="card">
                    <div class="icon">🚀</div>
                    <h3>Agilidade no dia a dia</h3>
                    <p>
                        Cadastre informações rapidamente e encontre tudo em telas organizadas,
                        com navegação simples e direta.
                    </p>
                </div>

                <div class="card">
                    <div class="icon">📊</div>
                    <h3>Controle do negócio</h3>
                    <p>
                        Visualize seus dados de forma prática e acompanhe clientes, produtos,
                        estoque e pedidos em um único ambiente.
                    </p>
                </div>

                <div class="card">
                    <div class="icon">🎯</div>
                    <h3>Visual profissional</h3>
                    <p>
                        Interface moderna, bonita e pensada para dar ao sistema uma aparência
                        mais confiável e agradável de usar.
                    </p>
                </div>
            </div>
        </section>

        <footer class="footer">
            © {{ date('Y') }} {{ config('app.name', 'Sistema Laravel') }} — desenvolvido com Laravel.
        </footer>
    </div>
</body>
</html>