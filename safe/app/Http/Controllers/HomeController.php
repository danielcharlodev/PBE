<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $user = Auth::user();

        if ($user->email === 'diretor@safe.com' && $user->role !== 'diretor') {
            $user->update(['role' => 'diretor', 'ativo' => true]);
        }

        return match ($user->role) {
            'diretor' => redirect()->route('diretor.dashboard'),
            'professor' => redirect()->route('professor.dashboard'),
            'portaria' => redirect()->route('portaria.dashboard'),
            default => redirect()->route('login')
                ->with('error', 'Seu usuário não possui cargo definido. Contate a administração.'),
        };
    }
}
