@extends('layouts.safe')

@section('title', 'Editar colaborador - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Editar colaborador</h2>
            <p class="page-subtitle">{{ $usuario->name }} — {{ $usuario->cargoLabel() }}</p>
        </div>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
            @csrf
            @method('PUT')
            @include('usuarios._form', ['usuario' => $usuario])
            <button type="submit" class="btn btn-primary btn-block-spaced">Atualizar</button>
        </form>
    </div>
@endsection
