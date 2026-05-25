@extends('layouts.safe')

@section('title', 'Entrada atrasada - SENAI')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="page-title">Entrada atrasada</h2>
            <p class="page-subtitle">Informe o horário em que o aluno entrou e as aulas com falta por causa do atraso.</p>
        </div>
        <a href="{{ route('solicitacoes.create') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    @if ($alunos->isEmpty())
        <div class="empty-state">
            <p>Cadastre um aluno (com curso) antes de criar uma solicitação.</p>
            <a href="{{ route('alunos.create') }}" class="btn btn-primary" style="margin-top:1rem;">Cadastrar aluno</a>
        </div>
    @else
        <div class="form-card">
            <form method="POST" action="{{ route('solicitacoes.store-entrada') }}">
                @csrf

                <div class="form-group">
                    <label for="aluno_id">Aluno</label>
                    <select id="aluno_id" name="aluno_id" class="form-control" required>
                        <option value="">Selecione o aluno</option>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id }}"
                                data-responsavel="{{ $aluno->responsavel_nome }}"
                                @selected(old('aluno_id') == $aluno->id)>
                                {{ $aluno->nome_completo }} — {{ $aluno->curso?->nomeCompleto() ?? 'Sem curso' }}
                            </option>
                        @endforeach
                    </select>
                    @error('aluno_id')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="horario_entrada">Horário em que o aluno entrou</label>
                    <input type="time" id="horario_entrada" name="horario_entrada" class="form-control"
                        value="{{ old('horario_entrada') }}" required>
                    @error('horario_entrada')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="responsavel_autorizou">Responsável que autorizou</label>
                    <input type="text" id="responsavel_autorizou" name="responsavel_autorizou" class="form-control"
                        value="{{ old('responsavel_autorizou') }}" required>
                    @error('responsavel_autorizou')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label>Faltas por causa da entrada (5 aulas)</label>
                    <p class="hint-text">Marque as aulas em que o aluno recebeu falta devido à entrada atrasada.</p>
                    <div class="aulas-grid">
                        @for ($i = 1; $i <= $totalAulas; $i++)
                            <label class="aula-check">
                                <input type="checkbox" name="aulas_falta[]" value="{{ $i }}"
                                    @checked(in_array($i, old('aulas_falta', [])))>
                                Aula {{ $i }}
                            </label>
                        @endfor
                    </div>
                    @error('aulas_falta')<p class="form-error">{{ $message }}</p>@enderror
                    @error('aulas_falta.*')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block-spaced">Registrar entrada atrasada</button>
            </form>
        </div>
    @endif
@endsection

@push('scripts')
<script>
document.getElementById('aluno_id')?.addEventListener('change', function () {
    const option = this.options[this.selectedIndex];
    const campo = document.getElementById('responsavel_autorizou');
    if (option?.dataset?.responsavel && campo && !campo.value) {
        campo.value = option.dataset.responsavel;
    }
});
</script>
@endpush
