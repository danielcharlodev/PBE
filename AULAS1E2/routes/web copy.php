<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/empresa', function() {
    return view('site/empresa');
});

Route::any('/any', function () {
    return "Permite todo o conteudo put, delete, get, post";
});

Route::match(['get', 'post'], '/match', function () {
    return "Permite acessos definidos";
});

Route::get("/produto/{id}/{nome}", function ($id,$nome) {
    return 'O id do produto é '.$id.  '<br>O meu nome é '.$nome;
});

Route::get("/produto/{id}/{nome?}", function ($id,$nome = '') {
    return 'O id do produto é '.$id.  '<br>O meu nome é '.$nome;
});

Route::get('/sobre', function () {
    return redirect('/empresa');
});

Route::redirect('/sobre', '/empresa');

Route::get('/news', function () {
    return view('site/news');
})->name('noticias');

Route::get('/novidades', function () {
    return redirect()->route('noticias');
});