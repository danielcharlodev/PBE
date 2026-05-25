<div class="form-group">
    <label for="nome_completo">Nome completo</label>
    <input id="nome_completo" type="text" name="nome_completo" class="form-control"
        value="{{ old('nome_completo', $aluno->nome_completo ?? '') }}" required>
    @error('nome_completo')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="cpf">CPF</label>
    <input id="cpf" type="text" name="cpf" class="form-control" data-mask="cpf"
        value="{{ old('cpf', isset($aluno) ? $aluno->cpf_formatado : '') }}" placeholder="000.000.000-00" required>
    @error('cpf')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="idade">Idade</label>
    <input id="idade" type="number" name="idade" class="form-control" min="1" max="120"
        value="{{ old('idade', $aluno->idade ?? '') }}" required>
    @error('idade')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="responsavel_nome">Nome do responsável</label>
    <input id="responsavel_nome" type="text" name="responsavel_nome" class="form-control"
        value="{{ old('responsavel_nome', $aluno->responsavel_nome ?? '') }}" required>
    @error('responsavel_nome')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="responsavel_telefone">Telefone do responsável</label>
    <input id="responsavel_telefone" type="text" name="responsavel_telefone" class="form-control" data-mask="telefone"
        value="{{ old('responsavel_telefone', $aluno->responsavel_telefone ?? '') }}" placeholder="(00) 00000-0000" required>
    @error('responsavel_telefone')<p class="form-error">{{ $message }}</p>@enderror
</div>

<div class="form-group">
    <label for="curso_id">Curso</label>
    @if ($cursos->isEmpty())
        <div class="info-inline">
            Nenhum curso cadastrado. <a href="{{ route('cursos.create') }}">Cadastre um curso</a> primeiro.
        </div>
    @else
        <select id="curso_id" name="curso_id" class="form-control" required>
            <option value="">Selecione o curso</option>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}" @selected(old('curso_id', $aluno->curso_id ?? '') == $curso->id)>
                    {{ $curso->nome }} — {{ $curso->tipoLabel() }} ({{ $curso->alunos_count }}/{{ $curso->vagas }} vagas)
                </option>
            @endforeach
        </select>
    @endif
    @error('curso_id')<p class="form-error">{{ $message }}</p>@enderror
</div>
