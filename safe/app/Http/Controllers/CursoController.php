<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\User;
use App\Support\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CursoController extends Controller
{
    public function index(): View
    {
        $cursos = Curso::query()
            ->withCount(['alunos', 'professores'])
            ->with('professores')
            ->orderBy('nome')
            ->get();

        return view('cursos.index', compact('cursos'));
    }

    public function create(): View
    {
        return view('cursos.create', [
            'professores' => $this->professoresDisponiveis(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validar($request);

        $curso = Curso::create([
            'nome' => trim($validated['nome']),
            'tipo' => $validated['tipo'],
            'vagas' => $validated['vagas'],
            'cadastrado_por' => auth()->id(),
        ]);

        $curso->professores()->sync($validated['professor_ids'] ?? []);
        $this->sincronizarCursoProfessores($curso);

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso cadastrado com sucesso!');
    }

    public function edit(Curso $curso): View
    {
        $curso->load('professores');

        return view('cursos.edit', [
            'curso' => $curso,
            'professores' => $this->professoresDisponiveis(),
            'professorIds' => $curso->professores->pluck('id')->all(),
        ]);
    }

    public function update(Request $request, Curso $curso): RedirectResponse
    {
        $validated = $this->validar($request, $curso);

        $curso->update([
            'nome' => trim($validated['nome']),
            'tipo' => $validated['tipo'],
            'vagas' => $validated['vagas'],
        ]);

        $curso->professores()->sync($validated['professor_ids'] ?? []);
        $this->sincronizarCursoProfessores($curso);

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Curso $curso): RedirectResponse
    {
        if ($curso->alunos()->exists()) {
            return back()->with('error', 'Não é possível excluir: existem alunos vinculados a este curso.');
        }

        $curso->professores()->detach();
        $curso->delete();

        return redirect()
            ->route('cursos.index')
            ->with('success', 'Curso removido.');
    }

    private function validar(Request $request, ?Curso $curso = null): array
    {
        return $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cursos', 'nome')
                    ->where(fn ($q) => $q->where('tipo', $request->input('tipo')))
                    ->ignore($curso?->id),
            ],
            'tipo' => ['required', Rule::in(array_keys(Curso::TIPOS))],
            'vagas' => 'required|integer|min:1|max:500',
            'professor_ids' => 'nullable|array|max:5',
            'professor_ids.*' => [
                'integer',
                Rule::exists('users', 'id')->where(fn ($q) => $q->where('role', UserRole::PROFESSOR)),
            ],
        ], [
            'professor_ids.max' => 'Selecione no máximo 5 professores.',
        ], [
            'nome' => 'nome do curso',
            'tipo' => 'tipo do curso',
            'vagas' => 'quantidade de vagas',
            'professor_ids' => 'professores',
        ]);
    }

    private function professoresDisponiveis()
    {
        return User::query()
            ->where('role', UserRole::PROFESSOR)
            ->where('ativo', true)
            ->orderBy('name')
            ->get();
    }

    private function sincronizarCursoProfessores(Curso $curso): void
    {
        $nome = $curso->nome;

        foreach ($curso->professores as $professor) {
            $professor->update(['curso' => $nome]);
        }
    }
}
