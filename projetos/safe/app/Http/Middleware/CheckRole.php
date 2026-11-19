<?php

namespace App\Http\Middleware;

use App\Support\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $role = auth()->user()->role;

        $permitido = in_array($role, $roles, true)
            || (UserRole::isAqv($role) && $this->rolesIncluemAqv($roles));

        if (! $permitido) {
            $label = $role ? UserRole::label($role) : 'não definido';

            return redirect()
                ->route('home')
                ->with('error', 'Acesso negado. Seu perfil atual é: '.$label.'. Use a conta correta ou peça à TI para ajustar o cargo.');
        }

        return $next($request);
    }

    private function rolesIncluemAqv(array $roles): bool
    {
        return ! empty(array_intersect($roles, UserRole::AQV_ALIASES));
    }
}
