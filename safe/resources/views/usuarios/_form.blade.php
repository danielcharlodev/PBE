@php
    $editando = isset($usuario);
    $cargo = old('role', $usuario->role ?? 'professor');
@endphp

<div class="form-group">
    <label for="role">Cargo</label>
    <select id="role" name="role" class="form-control" required @disabled($editando)>
        <option value="professor" @selected($cargo === 'professor')>Professor</option>
        <option value="portaria" @selected($cargo === 'portaria')>Portaria / Porteiro</option>
    </select>
    @if ($editando)
        <input type="hidden" name="role" value="{{ $usuario->role }}">
    @endif
    @error('role')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="name">Nome completo</label>
    <input id="name" type="text" name="name" class="form-control"
        value="{{ old('name', $usuario->name ?? '') }}" required>
    @error('name')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="email">E-mail (login)</label>
    <input id="email" type="email" name="email" class="form-control"
        value="{{ old('email', $usuario->email ?? '') }}" required>
    @error('email')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="cpf">CPF</label>
    <input id="cpf" type="text" name="cpf" class="form-control" data-mask="cpf"
        value="{{ old('cpf', isset($usuario) ? $usuario->cpf_formatado : '') }}" placeholder="000.000.000-00" required>
    @error('cpf')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="telefone">Telefone</label>
    <input id="telefone" type="text" name="telefone" class="form-control" data-mask="telefone"
        value="{{ old('telefone', $usuario->telefone ?? '') }}" placeholder="(00) 00000-0000" required>
    @error('telefone')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="matricula">Matrícula / código do colaborador</label>
    <input id="matricula" type="text" name="matricula" class="form-control"
        value="{{ old('matricula', $usuario->matricula ?? '') }}" placeholder="Ex: PROF-2026-001" required>
    @error('matricula')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div id="campos-professor" class="campos-cargo">
    <div class="form-group">
        <label for="curso">Curso / turma de atuação</label>
        <input id="curso" type="text" name="curso" class="form-control"
            value="{{ old('curso', $usuario->curso ?? '') }}" placeholder="Ex: Informática">
        @error('curso')<p class="form-error">{{ $message }}</p>@enderror
    </div>
</div>

<div id="campos-portaria" class="campos-cargo" style="display:none;">
    <div class="form-group">
        <label for="turno">Turno de trabalho</label>
        <select id="turno" name="turno" class="form-control">
            <option value="">Selecione</option>
            @foreach (\App\Models\User::TURNOS as $valor => $label)
                <option value="{{ $valor }}" @selected(old('turno', $usuario->turno ?? '') === $valor)>{{ $label }}</option>
            @endforeach
        </select>
        @error('turno')<p class="form-error">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="setor">Setor / posto na portaria</label>
        <input id="setor" type="text" name="setor" class="form-control"
            value="{{ old('setor', $usuario->setor ?? '') }}" placeholder="Ex: Portão principal">
        @error('setor')<p class="form-error">{{ $message }}</p>@enderror
    </div>
</div>

<div class="form-group">
    <label for="password">Senha{{ $editando ? ' (deixe em branco para manter)' : '' }}</label>
    <input id="password" type="password" name="password" class="form-control" {{ $editando ? '' : 'required' }}>
    @error('password')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="password_confirmation">Confirmar senha</label>
    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" {{ $editando ? '' : 'required' }}>
</div>

@push('scripts')
<script>
function alternarCamposCargo() {
    const cargo = document.getElementById('role')?.value;
    const prof = document.getElementById('campos-professor');
    const port = document.getElementById('campos-portaria');
    const curso = document.getElementById('curso');
    const turno = document.getElementById('turno');
    const setor = document.getElementById('setor');

    if (!prof || !port) return;

    if (cargo === 'professor') {
        prof.style.display = 'block';
        port.style.display = 'none';
        if (curso) curso.required = true;
        if (turno) turno.required = false;
        if (setor) setor.required = false;
    } else {
        prof.style.display = 'none';
        port.style.display = 'block';
        if (curso) curso.required = false;
        if (turno) turno.required = true;
        if (setor) setor.required = true;
    }
}

document.getElementById('role')?.addEventListener('change', alternarCamposCargo);
alternarCamposCargo();
</script>
@endpush
