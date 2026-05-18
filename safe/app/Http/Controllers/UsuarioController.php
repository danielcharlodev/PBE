<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $usuarios = User::query()
            ->equipe()
            ->with('cadastradoPor')
            ->latest()
            ->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        return view('usuarios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validar($request);

        User::create([
            ...$validated,
            'password' => $validated['password'],
            'ativo' => true,
            'cadastrado_por' => auth()->id(),
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuário cadastrado com sucesso! Informe o e-mail e a senha ao colaborador.');
    }

    public function edit(User $usuario): View
    {
        if (! in_array($usuario->role, ['professor', 'portaria'], true)) {
            abort(404);
        }

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        if (! in_array($usuario->role, ['professor', 'portaria'], true)) {
            abort(404);
        }

        $request->merge(['role' => $usuario->role]);
        $validated = $this->validar($request, $usuario, atualizando: true);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function toggleAtivo(User $usuario): RedirectResponse
    {
        if (! in_array($usuario->role, ['professor', 'portaria'], true)) {
            abort(404);
        }

        $usuario->update(['ativo' => ! $usuario->ativo]);

        $msg = $usuario->ativo ? 'Usuário reativado.' : 'Usuário desativado.';

        return back()->with('success', $msg);
    }

    private function validar(Request $request, ?User $usuario = null, bool $atualizando = false): array
    {
        $request->merge([
            'cpf' => User::normalizarCpf($request->input('cpf', '')),
        ]);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($usuario?->id),
            ],
            'cpf' => [
                'required',
                'string',
                'size:11',
                Rule::unique('users', 'cpf')->ignore($usuario?->id),
            ],
            'telefone' => 'required|string|max:20',
            'matricula' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'matricula')->ignore($usuario?->id),
            ],
            'role' => ['required', Rule::in(['professor', 'portaria'])],
        ];

        if ($atualizando) {
            $rules['password'] = ['nullable', 'confirmed', Password::defaults()];
        } else {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        if ($request->input('role') === 'professor') {
            $rules['curso'] = 'required|string|max:255';
            $rules['turno'] = 'nullable';
            $rules['setor'] = 'nullable';
        } else {
            $rules['turno'] = ['required', Rule::in(array_keys(User::TURNOS))];
            $rules['setor'] = 'required|string|max:255';
            $rules['curso'] = 'nullable';
        }

        $validated = $request->validate($rules, [], [
            'name' => 'nome completo',
            'cpf' => 'CPF',
            'matricula' => 'matrícula',
            'telefone' => 'telefone',
        ]);

        $validated['curso'] = $request->input('role') === 'professor'
            ? trim($validated['curso'] ?? '')
            : null;
        $validated['turno'] = $request->input('role') === 'portaria'
            ? $validated['turno']
            : null;
        $validated['setor'] = $request->input('role') === 'portaria'
            ? trim($validated['setor'] ?? '')
            : null;

        return $validated;
    }
}
