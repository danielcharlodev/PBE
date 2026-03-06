<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect()->route('admin.clientes');
});

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});


// // Caminho Padrão
// Route::get('admin/dashboard', function (){
//     return "dashboard";
// });

// Route::get('admin/users', function () {
//     return "users";
// });

// Route::get('admin/clientes', function () {
//     return "clientes";
// });

// Caminho com prefixo
// Route::prefix('admin')->group(function(){
//     Route::get('dashboard', function () {
//         return "dashboard";
//     });
    
//     Route::get('users', function (){
//         return "users";
//     });

//     Route::get('clientes', function () {
//         return "clientes";
//     });
// });

// Nomear caminhos com grupos
Route::name('admin.')->group(function() {
    Route::get('admin/dashboard', function () {
        return "dashboard";
    })->name('dashboard');

    Route::get('admin/users', function () {
        return "users";
    })->name('users');

    Route::get('admin/clientes', function () {
        return "clientes";
    })->name('clientes');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function(){

    Route::get('dashboard',function () {
        return "dashboard";
    })->name('dashboard');

    Route::get('users', function () {
        return "users";
    })->name('users');

    Route::get('clientes', function () {
        return "clientes";
    })->name('clientes');
});