@php
    $editando = isset($curso);
    $professorIds = $professorIds ?? [];
@endphp

<div class="form-group">
    <label for="nome">Nome do curso</label>
    <input id="nome" type="text" name="nome" class="form-control"
        value="{{ old('nome', $curso->nome ?? '') }}" placeholder="Ex: Informática Industrial" required>
    @error('nome')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-row-grid">
    <div class="form-group">
        <label for="tipo">Tipo do curso</label>
        <select id="tipo" name="tipo" class="form-control" required>
            <option value="">Selecione</option>
            @foreach (\App\Models\Curso::TIPOS as $valor => $label)
                <option value="{{ $valor }}" @selected(old('tipo', $curso->tipo ?? '') === $valor)>{{ $label }}</option>
            @endforeach
        </select>
        @error('tipo')<p class="form-error">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="vagas">Quantidade de vagas</label>
        <input id="vagas" type="number" name="vagas" class="form-control" min="1" max="500"
            value="{{ old('vagas', $curso->vagas ?? '') }}" required>
        @error('vagas')<p class="form-error">{{ $message }}</p>@enderror
    </div>
</div>

<div class="form-group">
    <label>Professores (máximo 5)</label>
    <p class="hint-text">Selecione os professores já cadastrados na equipe.</p>
    @if ($professores->isEmpty())
        <div class="info-inline">Cadastre professores em <a href="{{ route('usuarios.create') }}">Equipe</a> antes de vincular ao curso.</div>
    @else
        <div class="professor-picker" id="professor-picker">
            @foreach ($professores as $professor)
                <label class="professor-option">
                    <input type="checkbox" name="professor_ids[]" value="{{ $professor->id }}"
                        @checked(in_array($professor->id, old('professor_ids', $professorIds)))>
                    <span>{{ $professor->name }}</span>
                </label>
            @endforeach
        </div>
    @endif
    @error('professor_ids')<p class="form-error">{{ $message }}</p>@enderror
    @error('professor_ids.*')<p class="form-error">{{ $message }}</p>@enderror
</div>

@push('scripts')
<script>
(function () {
    const picker = document.getElementById('professor-picker');
    if (!picker) return;
    const max = 5;
    picker.querySelectorAll('input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', () => {
            const checked = picker.querySelectorAll('input[type="checkbox"]:checked');
            if (checked.length > max) {
                cb.checked = false;
                alert('Selecione no máximo 5 professores.');
            }
        });
    });
})();
</script>
@endpush
