@extends('layouts.safe')

@section('title', 'Cadastrar curso - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Cadastrar curso</h2>
            <p class="page-subtitle">Defina nome, tipo, vagas e até 5 professores.</p>
        </div>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('cursos.store') }}">
            @csrf
            @include('cursos._form', ['professores' => $professores])
            <button type="submit" class="btn btn-primary btn-block-spaced">Salvar curso</button>
        </form>
    </div>
@endsection
