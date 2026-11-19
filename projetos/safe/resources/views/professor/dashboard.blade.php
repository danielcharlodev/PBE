@extends('layouts.safe')

@section('title', 'Notificações - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Notificações</h2>
            <p class="page-subtitle">
                Cursos: <strong>{{ $user->cursosEnsino->pluck('nome')->join(', ') ?: ($user->curso ?? 'Não definido') }}</strong>
                — você recebe avisos de saídas e entradas atrasadas dos seus cursos.
            </p>
        </div>
    </div>

    @if (! auth()->user()->curso)
        <div class="alert alert-error">
            Seu usuário não possui curso vinculado. Peça ao AQV para configurar o campo curso no cadastro.
        </div>
    @endif

    @forelse ($notificacoes as $notificacao)
        <article @class(['notif-item', 'nao-lida' => ! $notificacao->lida, 'lida' => $notificacao->lida])>
            <h3 class="card-title">{{ $notificacao->titulo }}</h3>
            <p class="card-meta">{{ $notificacao->mensagem }}</p>
            <p class="card-meta" style="font-size:0.8rem;">{{ $notificacao->created_at->format('d/m/Y H:i') }}</p>

            @if (! $notificacao->lida)
                <form method="POST" action="{{ route('notificacoes.lida', $notificacao) }}" style="margin-top:0.75rem;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Marcar como lida</button>
                </form>
            @endif
        </article>
    @empty
        <div class="empty-state">
            <p>Nenhuma notificação no momento.</p>
        </div>
    @endforelse
@endsection
