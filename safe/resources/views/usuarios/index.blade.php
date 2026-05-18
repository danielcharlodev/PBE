@extends('layouts.safe')

@section('title', 'Equipe - SAFE')

@section('content')
    <div class="toolbar">
        <div>
            <h2 class="page-title">Equipe escolar</h2>
            <p class="page-subtitle">Professores e portaria cadastrados no sistema.</p>
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
                        <th></th>
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
                                    {{ $usuario->curso }}
                                @else
                                    {{ $usuario->setor }} ({{ $usuario->turnoLabel() }})
                                @endif
                            </td>
                            <td>
                                <span @class(['badge-status', 'badge-liberado' => $usuario->ativo, 'badge-pendente' => ! $usuario->ativo])>
                                    {{ $usuario->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td style="white-space:nowrap;">
                                <a href="{{ route('usuarios.edit', $usuario) }}">Editar</a>
                                <form method="POST" action="{{ route('usuarios.toggle-ativo', $usuario) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-secondary" style="padding:0.35rem 0.6rem;font-size:0.8rem;">
                                        {{ $usuario->ativo ? 'Desativar' : 'Reativar' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
