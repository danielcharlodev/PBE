<?php

use Illuminate\Foundation\Inspiring; // Classe que fornece frases/quotes inspiradoras
use Illuminate\Support\Facades\Artisan; // Facade para registrar comandos do Artisan (CLI)

Artisan::command('inspire', function () { // Cria um comando CLI: php artisan inspire
    $this->comment(Inspiring::quote()); // Imprime uma frase inspiradora no terminal
})->purpose('Display an inspiring quote'); // Descrição do comando (aparece no help/list)
