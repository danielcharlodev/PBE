@extends('layouts.safe')

@section('title', 'Cadastrar colaborador - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Cadastrar colaborador</h2>
            <p class="page-subtitle">Professor ou porteiro. Professores são vinculados aos cursos no cadastro de cursos.</p>
        </div>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf
            @include('usuarios._form')
            <button type="submit" class="btn btn-primary btn-block-spaced">Salvar colaborador</button>
        </form>
    </div>
@endsection
