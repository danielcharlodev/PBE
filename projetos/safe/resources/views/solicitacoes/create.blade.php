@extends('layouts.safe')

@section('title', 'Nova solicitação - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Nova solicitação</h2>
            <p class="page-subtitle">Escolha o tipo de autorização para registrar.</p>
        </div>
        <a href="{{ route('solicitacoes.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="dashboard-links">
        <a href="{{ route('solicitacoes.create-saida') }}" class="dashboard-link-card">
            <strong>Saída antecipada</strong>
            <span>Aluno sai antes do horário. Informe faltas nas aulas do dia.</span>
        </a>
        <a href="{{ route('solicitacoes.create-entrada') }}" class="dashboard-link-card">
            <strong>Entrada atrasada</strong>
            <span>Aluno chega após o horário. Informe quando entrou e as aulas com falta.</span>
        </a>
    </div>
@endsection
