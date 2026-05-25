@extends('layouts.safe')

@section('title', 'Solicitações - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Solicitações</h2>
            <p class="page-subtitle">Saídas antecipadas e entradas atrasadas registradas pelo AQV.</p>
        </div>
        <a href="{{ route('solicitacoes.create') }}" class="btn btn-primary">+ Nova solicitação</a>
    </div>

    @forelse ($solicitacoes as $solicitacao)
        <article class="card card--elevated">
            <div class="card-top">
                <h3 class="card-title">{{ $solicitacao->aluno->nome_completo }}</h3>
                <div style="display:flex;gap:0.5rem;flex-wrap:wrap;align-items:center;">
                    <span class="badge-status" style="background:#1e3a5f;color:#fff;">{{ $solicitacao->tipoLabel() }}</span>
                    <span @class(['badge-status', 'badge-pendente' => $solicitacao->status === 'pendente', 'badge-liberado' => $solicitacao->status === 'liberado'])>
                        {{ $solicitacao->status === 'pendente' ? 'Aguardando liberação' : 'Liberada' }}
                    </span>
                </div>
            </div>
            <p class="card-meta"><strong>Curso:</strong> {{ $solicitacao->aluno->curso?->nomeCompleto() ?? '—' }}</p>
            @if ($solicitacao->isEntradaAtrasada())
                <p class="card-meta"><strong>Horário em que entrou:</strong> {{ $solicitacao->horarioEntradaFormatado() }}</p>
                <p class="card-meta"><strong>Faltas por causa da entrada:</strong> {{ $solicitacao->aulasFaltaTexto() }}</p>
            @else
                <p class="card-meta"><strong>Horário de saída:</strong> {{ $solicitacao->horarioSaidaFormatado() }}</p>
                <p class="card-meta"><strong>Faltas:</strong> {{ $solicitacao->aulasFaltaTexto() }}</p>
            @endif
            <p class="card-meta"><strong>Responsável que autorizou:</strong> {{ $solicitacao->responsavel_autorizou }}</p>
            @if ($solicitacao->status === 'liberado')
                <p class="card-meta"><strong>Liberado em:</strong> {{ $solicitacao->liberado_em?->format('d/m/Y H:i') }}</p>
            @endif
        </article>
    @empty
        <div class="empty-state">
            <p>Nenhuma solicitação registrada.</p>
            <a href="{{ route('solicitacoes.create') }}" class="btn btn-primary" style="margin-top:1rem;">Nova solicitação</a>
        </div>
    @endforelse
@endsection
