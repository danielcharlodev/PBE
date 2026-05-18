<?php

namespace App\Http\Controllers;

use App\Models\CardSaida;
use App\Models\Notificacao;
use Illuminate\View\View;

class PortariaDashboardController extends Controller
{
    public function __invoke(): View
    {
        $cards = CardSaida::with('aluno')
            ->where('status', CardSaida::STATUS_PENDENTE)
            ->latest()
            ->get();

        $notificacoes = Notificacao::query()
            ->with(['cardSaida.aluno'])
            ->where('user_id', auth()->id())
            ->where('tipo', 'portaria')
            ->latest()
            ->limit(20)
            ->get();

        return view('portaria.dashboard', compact('cards', 'notificacoes'));
    }
}
