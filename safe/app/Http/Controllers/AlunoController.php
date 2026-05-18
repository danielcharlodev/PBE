<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AlunoController extends Controller
{
    public function index(): View
    {
        $alunos = Aluno::query()->latest()->get();

        return view('alunos.index', compact('alunos'));
    }

    public function create(): View
    {
        return view('alunos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'cpf' => Aluno::normalizarCpf($request->input('cpf', '')),
        ]);

        $validated = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'cpf' => ['required', 'string', 'size:11', Rule::unique('alunos', 'cpf')],
            'idade' => 'required|integer|min:1|max:120',
            'responsavel_nome' => 'required|string|max:255',
            'responsavel_telefone' => 'required|string|max:20',
            'curso' => 'required|string|max:255',
        ], [], [
            'nome_completo' => 'nome completo',
            'cpf' => 'CPF',
            'responsavel_nome' => 'nome do responsável',
            'responsavel_telefone' => 'telefone do responsável',
        ]);

        Aluno::create([
            ...$validated,
            'curso' => trim($validated['curso']),
            'cadastrado_por' => auth()->id(),
        ]);

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function edit(Aluno $aluno): View
    {
        return view('alunos.edit', compact('aluno'));
    }

    public function update(Request $request, Aluno $aluno): RedirectResponse
    {
        $request->merge([
            'cpf' => Aluno::normalizarCpf($request->input('cpf', '')),
        ]);

        $validated = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'cpf' => ['required', 'string', 'size:11', Rule::unique('alunos', 'cpf')->ignore($aluno->id)],
            'idade' => 'required|integer|min:1|max:120',
            'responsavel_nome' => 'required|string|max:255',
            'responsavel_telefone' => 'required|string|max:20',
            'curso' => 'required|string|max:255',
        ]);

        $validated['curso'] = trim($validated['curso']);
        $aluno->update($validated);

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Dados do aluno atualizados!');
    }
}
