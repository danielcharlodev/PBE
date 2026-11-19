@extends('layouts.safe')

@section('title', 'Cursos - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Cursos</h2>
            <p class="page-subtitle">Cadastre cursos CAI, TECNICO e FIC com professores e vagas.</p>
        </div>
        <a href="{{ route('cursos.create') }}" class="btn btn-primary">+ Novo curso</a>
    </div>

    @if ($cursos->isEmpty())
        <div class="empty-state">
            <p>Nenhum curso cadastrado.</p>
            <a href="{{ route('cursos.create') }}" class="btn btn-primary" style="margin-top:1rem;">Cadastrar curso</a>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Tipo</th>
                        <th>Vagas</th>
                        <th>Alunos</th>
                        <th>Professores</th>
                        <th class="table-actions-head">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                        <tr>
                            <td><strong>{{ $curso->nome }}</strong></td>
                            <td><span class="badge-tipo badge-tipo--{{ $curso->tipo }}">{{ $curso->tipoLabel() }}</span></td>
                            <td>{{ $curso->vagas }}</td>
                            <td>{{ $curso->alunos_count }} / {{ $curso->vagas }}</td>
                            <td>
                                @if ($curso->professores->isEmpty())
                                    <span class="text-muted">—</span>
                                @else
                                    <div class="chip-list">
                                        @foreach ($curso->professores as $prof)
                                            <span class="chip">{{ $prof->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="table-actions">
                                <div class="table-actions-inner">
                                    <a href="{{ route('cursos.edit', $curso) }}" class="btn-table btn-table-edit">
                                        Editar
                                    </a>
                                    <form method="POST"
                                        action="{{ route('cursos.destroy', $curso) }}"
                                        class="inline-form"
                                        onsubmit="return confirm('Excluir este curso?');">
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
