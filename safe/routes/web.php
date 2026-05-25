<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CardSaidaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DiretorDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortariaDashboardController;
use App\Http\Controllers\ProfessorDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home')
        : view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', HomeController::class)->name('home');
    Route::redirect('/dashboard', '/home')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::redirect('/diretor', '/aqv');

    Route::middleware('role:aqv')->group(function () {
        Route::get('/aqv', DiretorDashboardController::class)->name('aqv.dashboard');

        Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');
        Route::get('/cursos/create', [CursoController::class, 'create'])->name('cursos.create');
        Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
        Route::get('/cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit');
        Route::put('/cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
        Route::delete('/cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');

        Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');
        Route::get('/alunos/create', [AlunoController::class, 'create'])->name('alunos.create');
        Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');
        Route::get('/alunos/{aluno}/edit', [AlunoController::class, 'edit'])->name('alunos.edit');
        Route::put('/alunos/{aluno}', [AlunoController::class, 'update'])->name('alunos.update');

        Route::get('/solicitacoes', [CardSaidaController::class, 'index'])->name('solicitacoes.index');
        Route::get('/solicitacoes/create', [CardSaidaController::class, 'create'])->name('solicitacoes.create');
        Route::get('/solicitacoes/saida/create', [CardSaidaController::class, 'createSaida'])->name('solicitacoes.create-saida');
        Route::get('/solicitacoes/entrada-atrasada/create', [CardSaidaController::class, 'createEntradaAtrasada'])->name('solicitacoes.create-entrada');
        Route::post('/solicitacoes/saida', [CardSaidaController::class, 'storeSaida'])->name('solicitacoes.store-saida');
        Route::post('/solicitacoes/entrada-atrasada', [CardSaidaController::class, 'storeEntradaAtrasada'])->name('solicitacoes.store-entrada');
        Route::post('/solicitacoes', [CardSaidaController::class, 'store'])->name('solicitacoes.store');

        Route::redirect('/cards', '/solicitacoes')->name('cards.index');
        Route::redirect('/cards/create', '/solicitacoes/create')->name('cards.create');
        Route::post('/cards', [CardSaidaController::class, 'store'])->name('cards.store');

        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    });

    Route::middleware('role:professor')->group(function () {
        Route::get('/professor', [ProfessorDashboardController::class, 'index'])
            ->name('professor.dashboard');
        Route::post('/notificacoes/{notificacao}/lida', [ProfessorDashboardController::class, 'marcarLida'])
            ->name('notificacoes.lida');
    });

    Route::middleware('role:portaria')->group(function () {
        Route::get('/portaria', PortariaDashboardController::class)->name('portaria.dashboard');
        Route::post('/solicitacoes/{card}/liberar', [CardSaidaController::class, 'liberar'])
            ->name('solicitacoes.liberar');
        Route::post('/cards/{card}/liberar', [CardSaidaController::class, 'liberar'])
            ->name('cards.liberar');
    });
});

require __DIR__.'/auth.php';
