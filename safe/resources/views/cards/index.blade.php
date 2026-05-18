@extends('layouts.safe')

@section('title', 'Cards de saída - SAFE')

@section('content')
    <div class="toolbar">
        <div>
            <h2 class="page-title">Cards de saída</h2>
            <p class="page-subtitle">Autorizações criadas pela diretoria.</p>
        </div>
        <a href="{{ route('cards.create') }}" class="btn btn-primary">+ Novo card</a>
    </div>

    @forelse ($cards as $card)
        <article class="card">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
                <h3 class="card-title">{{ $card->aluno->nome_completo }}</h3>
                <span @class(['badge-status', 'badge-pendente' => $card->status === 'pendente', 'badge-liberado' => $card->status === 'liberado'])>
                    {{ $card->status === 'pendente' ? 'Aguardando portaria' : 'Liberado' }}
                </span>
            </div>
            <p class="card-meta"><strong>Curso:</strong> {{ $card->aluno->curso }}</p>
            <p class="card-meta"><strong>Horário de saída:</strong> {{ $card->horarioSaidaFormatado() }}</p>
            <p class="card-meta"><strong>Responsável que autorizou:</strong> {{ $card->responsavel_autorizou }}</p>
            <p class="card-meta"><strong>Faltas:</strong> {{ $card->aulasFaltaTexto() }}</p>
            @if ($card->status === 'liberado')
                <p class="card-meta"><strong>Liberado em:</strong> {{ $card->liberado_em?->format('d/m/Y H:i') }}</p>
            @endif
        </article>
    @empty
        <div class="empty-state">
            <p>Nenhum card de saída criado.</p>
            <a href="{{ route('cards.create') }}" class="btn btn-primary" style="margin-top:1rem;">Criar card</a>
        </div>
    @endforelse
@endsection
