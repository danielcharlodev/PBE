@extends('layouts.safe')

@section('title', 'Novo card de saída - SAFE')

@section('content')
    <div class="toolbar">
        <div>
            <h2 class="page-title">Criar card de saída</h2>
            <p class="page-subtitle">O professor do mesmo curso e a portaria serão notificados automaticamente.</p>
        </div>
        <a href="{{ route('cards.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    @if ($alunos->isEmpty())
        <div class="empty-state">
            <p>Cadastre um aluno antes de criar um card de saída.</p>
            <a href="{{ route('alunos.create') }}" class="btn btn-primary" style="margin-top:1rem;">Cadastrar aluno</a>
        </div>
    @else
        <div class="form-card">
            <form method="POST" action="{{ route('cards.store') }}" id="form-card">
                @csrf

                <div class="form-group">
                    <label for="aluno_id">Aluno</label>
                    <select id="aluno_id" name="aluno_id" class="form-control" required>
                        <option value="">Selecione o aluno</option>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id }}"
                                data-responsavel="{{ $aluno->responsavel_nome }}"
                                data-curso="{{ $aluno->curso }}"
                                @selected(old('aluno_id') == $aluno->id)>
                                {{ $aluno->nome_completo }} — {{ $aluno->curso }}
                            </option>
                        @endforeach
                    </select>
                    @error('aluno_id')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="horario_saida">Horário de saída</label>
                    <input type="time" id="horario_saida" name="horario_saida" class="form-control"
                        value="{{ old('horario_saida') }}" required>
                    @error('horario_saida')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="responsavel_autorizou">Responsável que autorizou a saída</label>
                    <input type="text" id="responsavel_autorizou" name="responsavel_autorizou" class="form-control"
                        value="{{ old('responsavel_autorizou') }}" required>
                    @error('responsavel_autorizou')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label>Faltas nas aulas do dia (5 aulas)</label>
                    <p class="page-subtitle" style="margin-bottom:0.75rem;">Marque as aulas em que o aluno ficará com falta.</p>
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
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;margin-top:0.75rem;">Criar card e notificar</button>
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
