<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfessorDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user()->load('cursosEnsino');

        $notificacoes = Notificacao::query()
            ->with(['cardSaida.aluno.curso'])
            ->where('user_id', $user->id)
            ->where('tipo', 'professor')
            ->latest()
            ->get();

        return view('professor.dashboard', compact('notificacoes', 'user'));
    }

    public function marcarLida(Notificacao $notificacao): RedirectResponse
    {
        if ($notificacao->user_id !== auth()->id()) {
            abort(403);
        }

        $notificacao->update(['lida' => true]);

        return back()->with('success', 'Notificação marcada como lida.');
    }
}
