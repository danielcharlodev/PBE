@extends('layouts.safe')

@section('title', 'Alunos - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Alunos cadastrados</h2>
            <p class="page-subtitle">Gerencie os alunos da escola.</p>
        </div>
        <a href="{{ route('alunos.create') }}" class="btn btn-primary">+ Novo aluno</a>
    </div>

    @if ($alunos->isEmpty())
        <div class="empty-state">
            <p>Nenhum aluno cadastrado.</p>
            <a href="{{ route('alunos.create') }}" class="btn btn-primary" style="margin-top:1rem;">Cadastrar aluno</a>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Idade</th>
                        <th>Curso</th>
                        <th>Responsável</th>
                        <th>Telefone</th>
                        <th class="table-actions-head">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->nome_completo }}</td>
                            <td>{{ $aluno->cpf_formatado }}</td>
                            <td>{{ $aluno->idade }}</td>
                            <td>{{ $aluno->curso?->nomeCompleto() ?? '—' }}</td>
                            <td>{{ $aluno->responsavel_nome }}</td>
                            <td>{{ $aluno->responsavel_telefone }}</td>
                            <td class="table-actions">
                                <div class="table-actions-inner">
                                    <a href="{{ route('alunos.edit', $aluno) }}" class="btn-table btn-table-edit">
                                        Editar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
