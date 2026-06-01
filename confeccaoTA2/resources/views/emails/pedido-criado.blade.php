<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Pedido</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 24px;">
    <h2 style="color: #5b21b6;">Olá, {{ $pedido->cliente->nome }}!</h2>
    <p>Seu pedido foi registrado em nossa planta fabril.</p>
    <p><strong>Código da Ordem:</strong> #{{ $pedido->id }}</p>
    @if($pedido->produto)
        <p><strong>Produto:</strong> {{ $pedido->produto->nome }} ({{ $pedido->quantidade }} un.)</p>
    @endif
    <p><strong>Valor Total das Peças:</strong> R$ {{ number_format((float) $pedido->valor_total, 2, ',', '.') }}</p>
    <p><strong>Status Atual:</strong> {{ $pedido->status }}</p>
    <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 24px 0;">
    <small style="color: #6b7280;">ERP Confecção — Monitoramento de Produção Automatizado</small>
</body>
</html>
