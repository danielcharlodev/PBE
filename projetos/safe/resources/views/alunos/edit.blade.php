@extends('layouts.safe')

@section('title', 'Editar aluno - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Editar aluno</h2>
            <p class="page-subtitle">{{ $aluno->nome_completo }}</p>
        </div>
        <a href="{{ route('alunos.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('alunos.update', $aluno) }}">
            @csrf
            @method('PUT')
            @include('alunos._form', ['aluno' => $aluno, 'cursos' => $cursos])
            <button type="submit" class="btn btn-primary btn-block-spaced">Atualizar aluno</button>
        </form>
    </div>
@endsection
