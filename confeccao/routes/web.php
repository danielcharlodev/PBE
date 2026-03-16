<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // =========================
    // DASHBOARD
    // =========================
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // =========================
    // CLIENTES
    // =========================

    // index
    Route::get('/clientes', [ClientesController::class, 'index'])
        ->name('clientes.index');

    // create
    Route::get('/clientes/create', [ClientesController::class, 'create'])
        ->name('clientes.create');

    // store
    Route::post('/clientes', [ClientesController::class, 'store'])
        ->name('clientes.store');

    // edit
    Route::get('/clientes/{id}/edit', [ClientesController::class, 'edit'])
        ->name('clientes.edit');

    // update
    Route::put('/clientes/{id}', [ClientesController::class, 'update'])
        ->name('clientes.update');

    // destroy
    Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])
        ->name('clientes.destroy');


    // =========================
    // ESTOQUE
    // =========================

    // index
    Route::get('/estoque', [EstoqueController::class, 'index'])
        ->name('estoque.index');

    // create
    Route::get('/estoque/create', [EstoqueController::class, 'create'])
        ->name('estoque.create');

    // store
    Route::post('/estoque', [EstoqueController::class, 'store'])
        ->name('estoque.store');

    // edit
    Route::get('/estoque/{id}/edit', [EstoqueController::class, 'edit'])
        ->name('estoque.edit');

    // update
    Route::put('/estoque/{id}', [EstoqueController::class, 'update'])
        ->name('estoque.update');

    // destroy
    Route::delete('/estoque/{id}', [EstoqueController::class, 'destroy'])
        ->name('estoque.destroy');


    // =========================
    // FORNECEDORES
    // =========================

    // index
    // =========================
// FORNECEDORES
// =========================

    // index
    Route::get('/fornecedores', [FornecedoresController::class, 'index'])
        ->name('fornecedores.index');

    // create
    Route::get('/fornecedores/create', [FornecedoresController::class, 'create'])
        ->name('fornecedores.create');

    // store
    Route::post('/fornecedores', [FornecedoresController::class, 'store'])
        ->name('fornecedores.store');

    // edit
    Route::get('/fornecedores/{id}/edit', [FornecedoresController::class, 'edit'])
        ->name('fornecedores.edit');

    // update
    Route::put('/fornecedores/{id}', [FornecedoresController::class, 'update'])
        ->name('fornecedores.update');

    // destroy
    Route::delete('/fornecedores/{id}', [FornecedoresController::class, 'destroy'])
        ->name('fornecedores.destroy');


    // =========================
    // PRODUTOS
    // =========================

    // index
    Route::get('/produtos', [ProdutosController::class, 'index'])
        ->name('produtos.index');

    // create
    Route::get('/produtos/create', [ProdutosController::class, 'create'])
        ->name('produtos.create');

    // store
    Route::post('/produtos', [ProdutosController::class, 'store'])
        ->name('produtos.store');

    // edit
    Route::get('/produtos/{id}/edit', [ProdutosController::class, 'edit'])
        ->name('produtos.edit');

    // update
    Route::put('/produtos/{id}', [ProdutosController::class, 'update'])
        ->name('produtos.update');

    // destroy
    Route::delete('/produtos/{id}', [ProdutosController::class, 'destroy'])
        ->name('produtos.destroy');


    // =========================
    // PEDIDOS
    // =========================

    Route::get('/pedidos', [PedidosController::class, 'index'])
        ->name('pedidos.index');

    // create
    Route::get('/pedidos/create', [PedidosController::class, 'create'])
        ->name('pedidos.create');

    // store
    Route::post('/pedidos', [PedidosController::class, 'store'])
        ->name('pedidos.store');

    // edit
    Route::get('/pedidos/{id}/edit', [PedidosController::class, 'edit'])
        ->name('pedidos.edit');

    // update
    Route::put('/pedidos/{id}', [PedidosController::class, 'update'])
        ->name('pedidos.update');

    // destroy
    Route::delete('/pedidos/{id}', [PedidosController::class, 'destroy'])
        ->name('pedidos.destroy');
});

Route::middleware('auth')->group(function () {

    // profile edit
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // profile update
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // profile destroy
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';