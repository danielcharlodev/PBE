<?php

namespace App\Http\Middleware;

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

        if (! in_array($role, $roles, true)) {
            return redirect()
                ->route('home')
                ->with('error', 'Acesso negado. Seu perfil atual é: '.($role ?: 'não definido').'. Use a conta correta ou peça à TI para ajustar o cargo.');
        }

        return $next($request);
    }
}
