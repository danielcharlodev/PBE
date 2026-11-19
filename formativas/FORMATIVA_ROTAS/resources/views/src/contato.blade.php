<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contato</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="container">
    <div class="topbar">
      <div class="brand">
        <span class="brand-badge"></span>
        <span>Painel do Site</span>
      </div>
      <div class="nav">
        <a class="btn" href="/empresa/{{ $msg }}">Empresa</a>
        <a class="btn" href="/noticias/{{ $msg }}">Notícias</a>
        <a class="btn" href="/contato/{{ $msg }}">Contato</a>
        <a class="btn" href="/publico">Público</a>
        <a class="btn" href="/restrito">Restrito</a>
        <a class="btn" href="/admin">Admin</a>
      </div>
    </div>

    <div class="grid">
      <div class="card">
        <div class="badge"><span class="dot"></span> View: Contato</div>
        <h1 class="h1">Página de Contato</h1>
        <p class="sub">Conteúdo diferente: canais de atendimento e informações de contato.</p>

        <div class="kv">
          <div class="label">Parâmetro recebido (msg)</div>
          <div class="value">{{ $msg }}</div>
        </div>

        <p class="small" style="margin-top:14px;">
          Você pode trocar o texto na URL para ver o parâmetro mudando.
        </p>
      </div>

      <div class="card">
        <h2 style="margin:0 0 8px 0;">Painel Admin</h2>
        <p class="small">Teste o grupo de rotas do exercício 06:</p>
        <div class="nav" style="justify-content:flex-start; margin-top:10px;">
          <a class="btn" href="/admin">/admin</a>
          <a class="btn" href="/admin/clientes">/admin/clientes</a>
          <a class="btn" href="/admin/produtos">/admin/produtos</a>
          <a class="btn" href="/admin/usuarios">/admin/usuarios</a>
        </div>
      </div>
    </div>

    <div class="footer">
      Acesse com parâmetro: <code>/contato/algum-texto</code>
    </div>
  </div>
</body>
</html>