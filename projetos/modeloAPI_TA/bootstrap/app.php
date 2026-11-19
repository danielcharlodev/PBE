<?php

use Illuminate\Foundation\Application; // Classe principal para configurar/criar a aplicação Laravel
use Illuminate\Foundation\Configuration\Exceptions; // Configuração de como exceções/erros serão tratados
use Illuminate\Foundation\Configuration\Middleware; // Configuração de middlewares (camadas antes/depois do controller)

return Application::configure(basePath: dirname(__DIR__)) // Define a pasta base do projeto (um nível acima de /bootstrap)
    ->withRouting( // Registra onde ficam as rotas da aplicação
        web: __DIR__.'/../routes/web.php', // Rotas HTTP “web” (GET/POST etc.)
        commands: __DIR__.'/../routes/console.php', // Comandos do Artisan (CLI)
        health: '/up', // Endpoint simples de “saúde” para checagem (ex.: monitoramento)
    ) // Fim da configuração de rotas
    ->withMiddleware(function (Middleware $middleware): void { // Permite registrar/configurar middlewares globais/grupos
        // Nenhum middleware custom global definido aqui (padrão do projeto).
    }) // Fim da configuração de middleware
    ->withExceptions(function (Exceptions $exceptions): void { // Permite configurar como erros/exceções serão reportados/renderizados
        // Nenhuma configuração extra de exceções definida aqui (padrão do projeto).
    })->create(); // Cria e retorna a instância final da aplicação (o “$app” do Laravel)
