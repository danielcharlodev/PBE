@extends('layouts.safe')

@section('title', 'Portaria - SAFE')

@section('content')
    <div class="toolbar">
        <div>
            <h2 class="page-title">Liberação no portão</h2>
            <p class="page-subtitle">Libere apenas alunos com card criado pela diretoria.</p>
        </div>
    </div>

    <h3 class="page-title" style="font-size:1.1rem;margin-bottom:0.75rem;">Aguardando liberação</h3>

    @forelse ($cards as $card)
        <article class="card">
            <h3 class="card-title">{{ $card->aluno->nome_completo }}</h3>
            <p class="card-meta"><strong>Curso:</strong> {{ $card->aluno->curso }}</p>
            <p class="card-meta"><strong>Horário de saída:</strong> {{ $card->horarioSaidaFormatado() }}</p>
            <p class="card-meta"><strong>Responsável que autorizou:</strong> {{ $card->responsavel_autorizou }}</p>
            <p class="card-meta"><strong>Faltas do aluno:</strong> {{ $card->aulasFaltaTexto() }}</p>

            <form method="POST" action="{{ route('cards.liberar', $card) }}" style="margin-top:1rem;">
                @csrf
                <button type="submit" class="btn btn-action">Liberar aluno no portão</button>
            </form>
        </article>
    @empty
        <div class="empty-state" style="margin-bottom:1.5rem;">
            <p>Nenhum aluno aguardando liberação.</p>
        </div>
    @endforelse

    @if ($notificacoes->isNotEmpty())
        <h3 class="page-title" style="font-size:1.1rem;margin:1.5rem 0 0.75rem;">Notificações recentes</h3>
        @foreach ($notificacoes as $notificacao)
            <article class="notif-item {{ $notificacao->lida ? 'lida' : 'nao-lida' }}">
                <h3 class="card-title" style="font-size:1rem;">{{ $notificacao->titulo }}</h3>
                <p class="card-meta">{{ $notificacao->mensagem }}</p>
            </article>
        @endforeach
    @endif
@endsection
