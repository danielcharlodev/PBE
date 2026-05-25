@extends('layouts.auth-guest')

@section('title', 'SENAI — Recuperar senha')

@section('brand-eyebrow', 'Recuperação de acesso')

@section('brand-title', 'Esqueceu sua senha?')

@section('brand-lead', 'Informe o e-mail cadastrado pela instituição. Enviaremos um link seguro para você criar uma nova senha.')

@section('brand-extra')
    <div class="brand-steps">
        <div class="brand-step">
            <span class="brand-step-num">1</span>
            <div>
                <h3>Informe o e-mail</h3>
                <p>Use o mesmo endereço cadastrado pelo AQV.</p>
            </div>
        </div>
        <div class="brand-step">
            <span class="brand-step-num">2</span>
            <div>
                <h3>Verifique a caixa de entrada</h3>
                <p>O link de redefinição chega em poucos minutos.</p>
            </div>
        </div>
        <div class="brand-step">
            <span class="brand-step-num">3</span>
            <div>
                <h3>Defina nova senha</h3>
                <p>Acesse o link e escolha uma senha segura.</p>
            </div>
        </div>
    </div>
@endsection

@section('card-title', 'Recuperar senha')

@section('card-subtitle', 'Enviaremos um link de redefinição para o seu e-mail')

@section('content')
    <a href="{{ route('login') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Voltar ao login
    </a>

    <div class="info-box">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
        </svg>
        <span>
            Se o e-mail estiver cadastrado, você receberá as instruções para redefinir a senha.
            Verifique também a pasta de spam.
        </span>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            Link enviado! Verifique sua caixa de entrada e siga as instruções do e-mail.
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">E-mail cadastrado</label>
            <div class="input-wrap">
                <input id="email" type="email" name="email" class="form-control"
                    value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="nome@instituicao.com">
                <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enviar link de recuperação</button>
    </form>
@endsection

@section('side-footer', 'Não recebeu o e-mail? Confirme o endereço com o AQV.')
