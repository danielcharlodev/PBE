<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CardSaidaController;
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:diretor')->group(function () {
        Route::get('/diretor', DiretorDashboardController::class)->name('diretor.dashboard');

        Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');
        Route::get('/alunos/create', [AlunoController::class, 'create'])->name('alunos.create');
        Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');
        Route::get('/alunos/{aluno}/edit', [AlunoController::class, 'edit'])->name('alunos.edit');
        Route::put('/alunos/{aluno}', [AlunoController::class, 'update'])->name('alunos.update');

        Route::get('/cards', [CardSaidaController::class, 'index'])->name('cards.index');
        Route::get('/cards/create', [CardSaidaController::class, 'create'])->name('cards.create');
        Route::post('/cards', [CardSaidaController::class, 'store'])->name('cards.store');

        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::patch('/usuarios/{usuario}/ativo', [UsuarioController::class, 'toggleAtivo'])->name('usuarios.toggle-ativo');
    });

    Route::middleware('role:professor')->group(function () {
        Route::get('/professor', [ProfessorDashboardController::class, 'index'])
            ->name('professor.dashboard');
        Route::post('/notificacoes/{notificacao}/lida', [ProfessorDashboardController::class, 'marcarLida'])
            ->name('notificacoes.lida');
    });

    Route::middleware('role:portaria')->group(function () {
        Route::get('/portaria', PortariaDashboardController::class)->name('portaria.dashboard');
        Route::post('/cards/{card}/liberar', [CardSaidaController::class, 'liberar'])
            ->name('cards.liberar');
    });
});

require __DIR__.'/auth.php';
