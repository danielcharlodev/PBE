<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AlunoController extends Controller
{
    public function index(): View
    {
        $alunos = Aluno::query()->with('curso')->latest()->get();

        return view('alunos.index', compact('alunos'));
    }

    public function create(): View
    {
        return view('alunos.create', [
            'cursos' => $this->cursosParaSelect(),
        ]);
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
            'curso_id' => 'required|exists:cursos,id',
        ], [], [
            'nome_completo' => 'nome completo',
            'cpf' => 'CPF',
            'responsavel_nome' => 'nome do responsável',
            'responsavel_telefone' => 'telefone do responsável',
            'curso_id' => 'curso',
        ]);

        $curso = Curso::findOrFail($validated['curso_id']);
        if ($curso->alunos()->count() >= $curso->vagas) {
            return back()
                ->withInput()
                ->with('error', 'Este curso já atingiu o limite de vagas ('.$curso->vagas.').');
        }

        Aluno::create([
            ...$validated,
            'cadastrado_por' => auth()->id(),
        ]);

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function edit(Aluno $aluno): View
    {
        return view('alunos.edit', [
            'aluno' => $aluno,
            'cursos' => $this->cursosParaSelect(),
        ]);
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
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $curso = Curso::findOrFail($validated['curso_id']);
        $ocupadas = $curso->alunos()->where('id', '!=', $aluno->id)->count();
        if ($ocupadas >= $curso->vagas) {
            return back()
                ->withInput()
                ->with('error', 'Este curso já atingiu o limite de vagas ('.$curso->vagas.').');
        }

        $aluno->update($validated);

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Dados do aluno atualizados!');
    }

    private function cursosParaSelect()
    {
        return Curso::query()->withCount('alunos')->orderBy('nome')->orderBy('tipo')->get();
    }
}
