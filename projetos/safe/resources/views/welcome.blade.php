@extends('layouts.auth-guest')

@section('title', 'SENAI — Entrar')

@section('card-title')
    @auth
        Olá, {{ auth()->user()->name }}
    @else
        Acesse sua conta
    @endauth
@endsection

@section('card-subtitle')
    @auth
        Você já está autenticado no sistema
    @else
        Entre com as credenciais da instituição
    @endauth
@endsection

@section('content')
    @auth
        <div class="logged-box">
            <p>Continue para o painel do seu perfil (<strong>{{ auth()->user()->cargoLabel() }}</strong>).</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Ir para o painel</a>
        </div>
    @else
        <div class="tabs" role="tablist">
            <button type="button" class="tab active" data-tab="login" role="tab">Entrar</button>
            <button type="button" class="tab" data-tab="acesso-info" role="tab">Primeiro acesso</button>
        </div>

        <div id="panel-login" class="panel active" role="tabpanel">
            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-wrap">
                        <input id="email" type="email" name="email" class="form-control"
                            value="{{ old('email') }}" required autofocus autocomplete="username"
                            placeholder="nome@instituicao.com">
                        <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <div class="input-wrap input-wrap--password">
                        <input id="password" type="password" name="password" class="form-control"
                            required autocomplete="current-password" placeholder="Digite sua senha">
                        <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        <button type="button" class="toggle-password" aria-label="Mostrar senha" data-toggle-password>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-row">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Lembrar de mim
                    </label>
                    @if (Route::has('password.request'))
                        <a class="link-muted" href="{{ route('password.request') }}">Esqueci a senha</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Entrar no sistema</button>
            </form>
        </div>

        <div id="panel-acesso-info" class="panel" role="tabpanel">
            <p class="panel-title">Como obter acesso</p>
                        <p class="panel-subtitle">Cursos, alunos e solicitações de saída são gerenciados pelo AQV.</p>

            <ul class="access-list">
                <li class="access-item">
                    <span class="access-icon">AQV</span>
                    <div>
                        <strong>AQV</strong>
                        <span>Conta principal criada na implantação do sistema.</span>
                    </div>
                </li>
                <li class="access-item">
                    <span class="access-icon">PRO</span>
                    <div>
                        <strong>Professor</strong>
                        <span>Cadastro em Equipe com e-mail e senha definidos.</span>
                    </div>
                </li>
                <li class="access-item">
                    <span class="access-icon">PRT</span>
                    <div>
                        <strong>Porteiro</strong>
                        <span>Cadastro com matrícula e setor pelo AQV.</span>
                    </div>
                </li>
            </ul>

            <button type="button" class="btn btn-secondary" data-tab-trigger="login">
                Já tenho login — Entrar
            </button>
        </div>
    @endauth
@endsection

@push('scripts')
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
        if (nome === 'acesso-info') {
            document.querySelectorAll('#panel-acesso-info .access-item').forEach((el, i) => {
                el.style.animation = 'none';
                el.offsetHeight;
                el.style.animation = '';
                el.style.animationDelay = (0.05 + i * 0.07) + 's';
            });
        }
    }

    const params = new URLSearchParams(window.location.search);
    if (params.get('tab') === 'acesso') ativarTab('acesso-info');

    const toggleBtn = document.querySelector('[data-toggle-password]');
    const passwordInput = document.getElementById('password');
    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleBtn.setAttribute('aria-label', isPassword ? 'Ocultar senha' : 'Mostrar senha');
        });
    }
</script>
@endpush
