<h1>Formulário - Restrito</h1>
<p>Essa rota permite apenas GET e POST. PUT e DELETE devem ser bloqueados.</p>

<hr>

<h2>Enviar como POST (permitido)</h2>
<form method="POST" action="/restrito">
    @csrf
    <label>Seu nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Sua idade:</label><br>
    <input type="number" name="idade" required><br><br>

    <label>Sua profissão:</label><br>
    <input type="text" name="profissao" required><br><br>

    <button type="submit">Enviar POST</button>
</form>

<hr>

<h2>Enviar como PUT (bloqueado)</h2>
<form method="POST" action="/restrito">
    @csrf
    @method('PUT')

    <label>Seu nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Sua idade:</label><br>
    <input type="number" name="idade" required><br><br>

    <label>Sua profissão:</label><br>
    <input type="text" name="profissao" required><br><br>

    <button type="submit">Enviar PUT</button>
</form>

<hr>

<h2>Enviar como DELETE (bloqueado)</h2>
<form method="POST" action="/restrito">
    @csrf
    @method('DELETE')

    <label>Seu nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Sua idade:</label><br>
    <input type="number" name="idade" required><br><br>

    <label>Sua profissão:</label><br>
    <input type="text" name="profissao" required><br><br>

    <button type="submit">Enviar DELETE</button>
</form>