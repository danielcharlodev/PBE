@extends('layouts.safe')

@section('title', 'Painel do diretor - SAFE')

@section('content')
    <div class="toolbar">
        <div>
            <h2 class="page-title">Painel do diretor</h2>
            <p class="page-subtitle">Cadastre alunos e crie cards de saída autorizados.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card"><span>Alunos</span><strong>{{ $totalAlunos }}</strong></div>
        <div class="stat-card"><span>Equipe</span><strong>{{ $totalEquipe }}</strong></div>
        <div class="stat-card"><span>Cards pendentes</span><strong>{{ $cardsPendentes }}</strong></div>
        <div class="stat-card"><span>Alunos liberados</span><strong>{{ $cardsLiberados }}</strong></div>
    </div>

    <div class="dashboard-links">
        <a href="{{ route('usuarios.create') }}" class="dashboard-link-card">
            <strong>Cadastrar professor / portaria</strong>
            <span>E-mail, senha, CPF, matrícula e dados do cargo.</span>
        </a>
        <a href="{{ route('usuarios.index') }}" class="dashboard-link-card">
            <strong>Ver equipe</strong>
            <span>Professores e porteiros cadastrados.</span>
        </a>
        <a href="{{ route('alunos.create') }}" class="dashboard-link-card">
            <strong>Cadastrar aluno</strong>
            <span>Nome, CPF, idade, responsável, telefone e curso.</span>
        </a>
        <a href="{{ route('alunos.index') }}" class="dashboard-link-card">
            <strong>Ver alunos</strong>
            <span>Lista completa dos alunos cadastrados.</span>
        </a>
        <a href="{{ route('cards.create') }}" class="dashboard-link-card">
            <strong>Criar card de saída</strong>
            <span>Notifica professor (mesmo curso) e portaria.</span>
        </a>
        <a href="{{ route('cards.index') }}" class="dashboard-link-card">
            <strong>Ver cards</strong>
            <span>Acompanhe saídas pendentes e liberadas.</span>
        </a>
    </div>
@endsection
