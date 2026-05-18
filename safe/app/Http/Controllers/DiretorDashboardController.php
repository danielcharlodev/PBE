<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\CardSaida;
use Illuminate\View\View;

class DiretorDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('diretor.dashboard', [
            'totalAlunos' => Aluno::count(),
            'totalEquipe' => \App\Models\User::equipe()->count(),
            'cardsPendentes' => CardSaida::where('status', CardSaida::STATUS_PENDENTE)->count(),
            'cardsLiberados' => CardSaida::where('status', CardSaida::STATUS_LIBERADO)->count(),
        ]);
    }
}
