@extends('layouts.auth-guest')

@section('title', 'SENAI — Nova senha')

@section('brand-eyebrow', 'Redefinição')

@section('brand-title', 'Crie uma nova senha')

@section('brand-lead', 'Escolha uma senha forte e exclusiva. Após salvar, você poderá entrar normalmente no sistema.')

@section('brand-extra')
    <div class="brand-steps">
        <div class="brand-step">
            <span class="brand-step-num">✓</span>
            <div>
                <h3>Link validado</h3>
                <p>Você acessou o formulário pelo e-mail de recuperação.</p>
            </div>
        </div>
        <div class="brand-step">
            <span class="brand-step-num">2</span>
            <div>
                <h3>Nova senha</h3>
                <p>Use pelo menos 8 caracteres, combinando letras e números.</p>
            </div>
        </div>
        <div class="brand-step">
            <span class="brand-step-num">3</span>
            <div>
                <h3>Pronto</h3>
                <p>Faça login com a nova senha no painel SENAI.</p>
            </div>
        </div>
    </div>
@endsection

@section('card-title', 'Nova senha')

@section('card-subtitle', 'Preencha os campos abaixo para concluir a recuperação')

@section('content')
    <a href="{{ route('login') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Voltar ao login
    </a>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email">E-mail</label>
            <div class="input-wrap">
                <input id="email" type="email" name="email" class="form-control"
                    value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                    placeholder="nome@instituicao.com">
                <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Nova senha</label>
            <div class="input-wrap input-wrap--password">
                <input id="password" type="password" name="password" class="form-control"
                    required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <button type="button" class="toggle-password" aria-label="Mostrar senha" data-toggle-password="password">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar senha</label>
            <div class="input-wrap input-wrap--password">
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                    required autocomplete="new-password" placeholder="Repita a nova senha">
                <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <button type="button" class="toggle-password" aria-label="Mostrar senha" data-toggle-password="password_confirmation">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar nova senha</button>
    </form>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('[data-toggle-password]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-toggle-password');
            const input = document.getElementById(id);
            if (!input) return;
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            btn.setAttribute('aria-label', isPassword ? 'Ocultar senha' : 'Mostrar senha');
        });
    });
</script>
@endpush
