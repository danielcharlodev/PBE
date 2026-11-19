<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/empresa/{msg}', function ($msg) {
    return view('src.empresa', ['msg' => $msg]);
});

Route::get('/noticias/{msg}', function ($msg) {
    return view('src.noticias', ['msg' => $msg]);
})->name('noticias');

Route::get('/contato/{msg}', function ($msg) {
    return view('src.contato', ['msg' => $msg]);
});

Route::any('/publico', function () {
    return "ACESSO PÚBLICO: permite GET, POST, PUT, DELETE";
});

// Permitidos
Route::match(['get', 'post'], '/restrito', function () {
    return "ACESSO RESTRITO: permitido apenas GET e POST";
});

// Bloqueados
Route::match(['put', 'delete'], '/restrito', function () {
    return "RESTRIÇÃO: PUT e DELETE não são permitidos nesta rota!";
});

Route::get('/sobre', function () {
    return redirect('/empresa/veio-do-sobre');
});

Route::get('/novidades', function () {
    return redirect()->route('noticias', ['msg' => 'veio-por-nome-de-rota']);
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {

    Route::get('/', function () {
        return "PAINEL ADMINISTRATIVO - área de gerenciamento";
    })->name('painel');

    Route::get('/clientes', function () {
        return "ADMIN - gerenciamento de CLIENTES";
    })->name('clientes');

    Route::get('/produtos', function () {
        return "ADMIN - gerenciamento de PRODUTOS";
    })->name('produtos');

    Route::get('/usuarios', function () {
        return "ADMIN - gerenciamento de USUÁRIOS";
    })->name('usuarios');

});