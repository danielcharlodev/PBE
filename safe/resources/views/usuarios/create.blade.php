@extends('layouts.safe')

@section('title', 'Cadastrar colaborador - SAFE')

@section('content')
    <div class="toolbar">
        <div>
            <h2 class="page-title">Cadastrar colaborador</h2>
            <p class="page-subtitle">Professor ou portaria. O e-mail e a senha serão usados no login.</p>
        </div>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf
            @include('usuarios._form')
            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:0.75rem;">Salvar colaborador</button>
        </form>
    </div>
@endsection
