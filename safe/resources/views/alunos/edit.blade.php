@extends('layouts.safe')

@section('title', 'Editar aluno - SAFE')

@section('content')
    <div class="toolbar">
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
            @include('alunos._form', ['aluno' => $aluno])
            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:0.5rem;">Atualizar aluno</button>
        </form>
    </div>
@endsection
