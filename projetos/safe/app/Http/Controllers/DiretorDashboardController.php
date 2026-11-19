<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\CardSaida;
use App\Models\Curso;
use Illuminate\View\View;

class DiretorDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('diretor.dashboard', [
            'totalCursos' => Curso::count(),
            'totalAlunos' => Aluno::count(),
            'totalEquipe' => \App\Models\User::equipe()->count(),
            'solicitacoesPendentes' => CardSaida::where('status', CardSaida::STATUS_PENDENTE)->count(),
            'solicitacoesLiberadas' => CardSaida::where('status', CardSaida::STATUS_LIBERADO)->count(),
        ]);
    }
}
