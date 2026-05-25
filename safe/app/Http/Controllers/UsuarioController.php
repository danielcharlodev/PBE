<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $usuarios = User::query()
            ->equipe()
            ->with(['cadastradoPor', 'cursosEnsino'])
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
        if (! in_array($usuario->role, UserRole::EQUIPE, true)) {
            abort(404);
        }

        return view('usuarios.edit', [
            'usuario' => $usuario,
        ]);
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        if (! in_array($usuario->role, UserRole::EQUIPE, true)) {
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

    public function destroy(User $usuario): RedirectResponse
    {
        if (! in_array($usuario->role, UserRole::EQUIPE, true)) {
            abort(404);
        }

        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'Você não pode excluir seu próprio usuário.');
        }

        DB::transaction(function () use ($usuario) {
            $usuario->cursosEnsino()->detach();

            DB::table('users')
                ->where('cadastrado_por', $usuario->id)
                ->update(['cadastrado_por' => null]);

            $usuario->delete();
        });

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Colaborador excluído com sucesso.');
    }

    private function validar(Request $request, ?User $usuario = null, bool $atualizando = false): array
    {
        $request->merge([
            'cpf' => User::normalizarCpf($request->input('cpf', '')),
            'telefone' => User::normalizarTelefone($request->input('telefone', '')),
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
            'telefone' => [
                'required',
                'string',
                'min:10',
                'max:11',
                Rule::unique('users', 'telefone')->ignore($usuario?->id),
            ],
            'matricula' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'matricula')->ignore($usuario?->id),
            ],
            'role' => ['required', Rule::in(UserRole::EQUIPE)],
        ];

        if ($atualizando) {
            $rules['password'] = ['nullable', 'confirmed', Password::defaults()];
        } else {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        if ($request->input('role') === UserRole::PROFESSOR) {
            $rules['turno'] = 'nullable';
            $rules['setor'] = 'nullable';
        } else {
            $rules['turno'] = ['required', Rule::in(array_keys(User::TURNOS))];
            $rules['setor'] = 'required|string|max:255';
            $rules['curso'] = 'nullable';
        }

        $validated = $request->validate($rules, [
            'email.unique' => 'Este e-mail já está cadastrado no sistema.',
            'cpf.unique' => 'Este CPF já está cadastrado no sistema.',
            'telefone.unique' => 'Este telefone já está cadastrado no sistema.',
        ], [
            'name' => 'nome completo',
            'email' => 'e-mail',
            'cpf' => 'CPF',
            'matricula' => 'matrícula',
            'telefone' => 'telefone',
        ]);

        $validated['curso'] = null;
        $validated['turno'] = $request->input('role') === UserRole::PORTARIA
            ? $validated['turno']
            : null;
        $validated['setor'] = $request->input('role') === UserRole::PORTARIA
            ? trim($validated['setor'] ?? '')
            : null;

        return $validated;
    }
}
