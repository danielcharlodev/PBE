<h1>Formulário - Público</h1>
<p>Essa rota é pública e aceita POST, PUT e DELETE.</p>

<hr>

<h2>Enviar como POST</h2>
<form method="POST" action="/publico">
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

<h2>Enviar como PUT</h2>
<form method="POST" action="/publico">
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

<h2>Enviar como DELETE</h2>
<form method="POST" action="/publico">
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