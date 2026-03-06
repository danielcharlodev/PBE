<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Empresa</title>
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
        <div class="badge"><span class="dot"></span> View: Empresa</div>
        <h1 class="h1">Página da Empresa</h1>
        <p class="sub">Conteúdo diferente: informações institucionais, história, missão e valores.</p>

        <div class="kv">
          <div class="label">Mensagem recebida: (msg)</div>
          <div class="value">{{ $msg }}</div>
        </div>

        <p class="small" style="margin-top:14px;">
          Dica: teste o redirect em <code>/sobre</code> (vai cair aqui com um parâmetro).
        </p>
      </div>

      <div class="card">
        <h2 style="margin:0 0 8px 0;">Atalhos</h2>
        <p class="small">Links úteis para testar os exercícios:</p>
        <div class="nav" style="justify-content:flex-start; margin-top:10px;">
          <a class="btn" href="/sobre">/sobre (redirect)</a>
          <a class="btn" href="/novidades">/novidades (por nome)</a>
          <a class="btn" href="/admin/clientes">Admin Clientes</a>
          <a class="btn" href="/admin/produtos">Admin Produtos</a>
        </div>
      </div>
    </div>

    <div class="footer">
      Laravel Rotas • Acesse com parâmetro: <code>/empresa/algum-texto</code>
    </div>
  </div>
</body>
</html>