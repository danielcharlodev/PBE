@extends('layouts.safe')

@section('title', 'Painel AQV - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Painel AQV</h2>
            <p class="page-subtitle">Visão geral do controle de acesso escolar.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card"><span>Cursos</span><strong>{{ $totalCursos }}</strong></div>
        <div class="stat-card"><span>Alunos</span><strong>{{ $totalAlunos }}</strong></div>
        <div class="stat-card"><span>Equipe</span><strong>{{ $totalEquipe }}</strong></div>
        <div class="stat-card"><span>Saídas pendentes</span><strong>{{ $solicitacoesPendentes }}</strong></div>
        <div class="stat-card"><span>Saídas liberadas</span><strong>{{ $solicitacoesLiberadas }}</strong></div>
    </div>

    <div class="dashboard-links">
        <a href="{{ route('cursos.create') }}" class="dashboard-link-card">
            <strong>Cadastrar curso</strong>
            <span>CAI, TECNICO ou FIC — até 5 professores e vagas.</span>
        </a>
        <a href="{{ route('cursos.index') }}" class="dashboard-link-card">
            <strong>Ver cursos</strong>
            <span>Lista de cursos, professores e ocupação de vagas.</span>
        </a>
        <a href="{{ route('usuarios.create') }}" class="dashboard-link-card">
            <strong>Cadastrar professor / porteiro</strong>
            <span>E-mail, senha, CPF, matrícula e dados do cargo.</span>
        </a>
        <a href="{{ route('alunos.create') }}" class="dashboard-link-card">
            <strong>Cadastrar aluno</strong>
            <span>Vincule o aluno a um curso cadastrado.</span>
        </a>
        <a href="{{ route('solicitacoes.create') }}" class="dashboard-link-card">
            <strong>Nova solicitação</strong>
            <span>Saída antecipada ou entrada atrasada — notifica professor e porteiro.</span>
        </a>
        <a href="{{ route('solicitacoes.index') }}" class="dashboard-link-card">
            <strong>Ver solicitações</strong>
            <span>Saídas e entradas pendentes ou liberadas.</span>
        </a>
    </div>
@endsection
