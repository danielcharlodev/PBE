@extends('layouts.safe')

@section('title', 'Editar curso - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Editar curso</h2>
            <p class="page-subtitle">{{ $curso->nomeCompleto() }}</p>
        </div>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('cursos.update', $curso) }}">
            @csrf
            @method('PUT')
            @include('cursos._form', ['curso' => $curso, 'professores' => $professores, 'professorIds' => $professorIds])
            <button type="submit" class="btn btn-primary btn-block-spaced">Atualizar curso</button>
        </form>
    </div>
@endsection
