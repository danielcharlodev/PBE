@extends('layouts.safe')

@section('title', 'Cadastrar aluno - SAFE')

@section('content')
    <div class="toolbar">
        <div>
            <h2 class="page-title">Cadastrar aluno</h2>
            <p class="page-subtitle">Preencha os dados do aluno e do responsável.</p>
        </div>
        <a href="{{ route('alunos.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('alunos.store') }}">
            @csrf
            @include('alunos._form')
            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:0.5rem;">Salvar aluno</button>
        </form>
    </div>
@endsection
