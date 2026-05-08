<?php

use Illuminate\Foundation\Application; // Tipo/contrato da aplicação Laravel (container principal)
use Illuminate\Http\Request; // Classe que representa a requisição HTTP atual

define('LARAVEL_START', microtime(true)); // Marca o início do request (usado para medir tempo de execução)

// Verifica se o app está em modo manutenção (quando o Laravel “derruba” a app para manutenção).
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) { // Se existir o arquivo de manutenção...
    require $maintenance; // ...carrega esse arquivo, que normalmente retorna uma resposta de manutenção
} // Fim do bloco de manutenção

// Registra o autoloader do Composer (para carregar classes automaticamente).
require __DIR__.'/../vendor/autoload.php'; // Carrega dependências e classes do projeto via Composer

// Inicializa (bootstrap) o Laravel e prepara a aplicação para atender a requisição.
/** @var Application $app */ // Ajuda o editor/IDE a entender o tipo da variável $app
$app = require_once __DIR__.'/../bootstrap/app.php'; // Monta a instância da aplicação (container + config + rotas)

$app->handleRequest(Request::capture()); // Captura a requisição atual e manda o Laravel processar (rotas/middlewares/controllers)
