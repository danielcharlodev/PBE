@extends('layouts.safe')

@section('title', 'Portaria - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Liberação — Porteiro</h2>
            <p class="page-subtitle">Libere apenas alunos com autorização registrada pelo AQV.</p>
        </div>
    </div>

    <h3 class="section-title">Aguardando liberação</h3>

    @forelse ($cards as $card)
        <article class="card">
            <div class="card-top" style="margin-bottom:0.5rem;">
                <h3 class="card-title">{{ $card->aluno->nome_completo }}</h3>
                <span class="badge-status" style="background:#1e3a5f;color:#fff;">{{ $card->tipoLabel() }}</span>
            </div>
            <p class="card-meta"><strong>Curso:</strong> {{ $card->aluno->curso?->nomeCompleto() ?? '—' }}</p>
            @if ($card->isEntradaAtrasada())
                <p class="card-meta"><strong>Horário em que entrou:</strong> {{ $card->horarioEntradaFormatado() }}</p>
                <p class="card-meta"><strong>Faltas por causa da entrada:</strong> {{ $card->aulasFaltaTexto() }}</p>
            @else
                <p class="card-meta"><strong>Horário de saída:</strong> {{ $card->horarioSaidaFormatado() }}</p>
                <p class="card-meta"><strong>Faltas do aluno:</strong> {{ $card->aulasFaltaTexto() }}</p>
            @endif
            <p class="card-meta"><strong>Responsável que autorizou:</strong> {{ $card->responsavel_autorizou }}</p>

            <form method="POST" action="{{ route('solicitacoes.liberar', $card) }}" style="margin-top:1rem;">
                @csrf
                <button type="submit" class="btn btn-action">
                    {{ $card->isEntradaAtrasada() ? 'Liberar entrada' : 'Liberar saída' }}
                </button>
            </form>
        </article>
    @empty
        <div class="empty-state" style="margin-bottom:1.5rem;">
            <p>Nenhum aluno aguardando liberação.</p>
        </div>
    @endforelse
@endsection
