@extends('layouts.safe')

@section('title', 'Equipe - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Equipe escolar</h2>
            <p class="page-subtitle">Professores e porteiros cadastrados no sistema.</p>
        </div>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">+ Novo colaborador</a>
    </div>

    @if ($usuarios->isEmpty())
        <div class="empty-state">
            <p>Nenhum professor ou porteiro cadastrado.</p>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary" style="margin-top:1rem;">Cadastrar colaborador</a>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>E-mail</th>
                        <th>Matrícula</th>
                        <th>Curso / Setor</th>
                        <th>Status</th>
                        <th class="table-actions-head">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->cargoLabel() }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->matricula }}</td>
                            <td>
                                @if ($usuario->role === 'professor')
                                    {{ $usuario->cursosEnsino->map(fn ($c) => $c->nomeCompleto())->join(', ') ?: '—' }}
                                @else
                                    {{ $usuario->setor }} ({{ $usuario->turnoLabel() }})
                                @endif
                            </td>
                            <td>
                                <span @class(['badge-status', 'badge-liberado' => $usuario->ativo, 'badge-pendente' => ! $usuario->ativo])>
                                    {{ $usuario->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td class="table-actions">
                                <div class="table-actions-inner">
                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn-table btn-table-edit">
                                        Editar
                                    </a>
                                    <form method="POST"
                                        action="{{ route('usuarios.destroy', $usuario) }}"
                                        class="inline-form"
                                        onsubmit="return confirm('Excluir {{ $usuario->name }}? Esta ação não pode ser desfeita.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table btn-table-delete">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
