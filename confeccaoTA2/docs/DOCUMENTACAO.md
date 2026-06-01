# Documentação — ERP Confecção TA2

Sistema web para gestão de confecção: clientes, fornecedores, insumos, produtos, pedidos, estoque e controle de acesso por cargos.

**Tecnologias:** Laravel 13, Filament 5 (painel admin), MySQL, Spatie Permission (RBAC).

---

## Índice

1. [Instalação passo a passo](#1-instalação-passo-a-passo)
2. [Primeiro acesso](#2-primeiro-acesso)
3. [Uso do sistema (passo a passo)](#3-uso-do-sistema-passo-a-passo)
4. [Fluxos automáticos importantes](#4-fluxos-automáticos-importantes)
5. [Segurança e permissões](#5-segurança-e-permissões)
6. [Como funciona o código](#6-como-funciona-o-código)
7. [Estrutura de pastas](#7-estrutura-de-pastas)
8. [Banco de dados](#8-banco-de-dados)
9. [Comandos úteis](#9-comandos-úteis)
10. [Problemas comuns](#10-problemas-comuns)

---

## 1. Instalação passo a passo

### 1.1 Pré-requisitos

- PHP 8.3+
- Composer
- MySQL (Laragon, XAMPP, etc.)
- Extensões PHP: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`

### 1.2 Clonar / abrir o projeto

```bash
cd C:\laragon\www\Charlo\PBE\confeccaota2
```

### 1.3 Instalar dependências

```bash
composer install
```

### 1.4 Configurar ambiente

Copie o arquivo de exemplo e gere a chave:

```bash
copy .env.example .env
php artisan key:generate
```

Edite o `.env` com os dados do MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=confeccaota2
DB_USERNAME=root
DB_PASSWORD=

APP_NAME="ERP Confecção"
```

Crie o banco no MySQL (phpMyAdmin ou terminal):

```sql
CREATE DATABASE confeccaota2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 1.5 Rodar migrations e dados iniciais

```bash
php artisan migrate
php artisan db:seed
```

Isso cria as tabelas e o usuário administrador.

### 1.6 Subir o servidor

Com Laragon: aponte o virtual host para a pasta `public`.

Ou via Artisan:

```bash
php artisan serve
```

Acesse: **http://127.0.0.1:8000/admin**

### 1.7 Limpar cache (após mudanças de permissão ou config)

```bash
php artisan optimize:clear
```

---

## 2. Primeiro acesso

| Campo    | Valor                 |
|----------|------------------------|
| URL      | `/admin`               |
| E-mail   | `admin@confeccao.com`  |
| Senha    | `password`             |

O usuário admin recebe o cargo **Admin** e vê todos os menus.

Se o menu lateral estiver vazio, rode:

```bash
php artisan confeccao:ensure-admin
php artisan optimize:clear
```

Faça logout e login novamente.

---

## 3. Uso do sistema (passo a passo)

### 3.1 Dashboard

Ao entrar, você vê:

- Total de clientes e produtos
- Pedidos pendentes
- Faturamento acumulado

### 3.2 Cadastros → Clientes

1. Menu **Cadastros** → **Clientes** → **Criar**
2. Preencha:
   - Nome completo
   - E-mail (opcional)
   - WhatsApp — máscara `(11) 99999-9999`
   - CPF ou CNPJ — formatação automática; **não pode repetir** outro cliente
3. Salvar

### 3.3 Cadastros → Fornecedores

1. **Fornecedores** → **Criar**
2. Razão social, e-mail, telefone (com máscara), CNPJ (com máscara `00.000.000/0000-00`)
3. **CNPJ único** no sistema — não aceita duplicado
4. Salvar

### 3.4 Cadastros → Insumos

Materiais de produção (tecido, linha, etc.):

1. Nome, unidade (Metros, Kg, etc.), preço de custo, estoque
2. Salvar

### 3.5 Cadastros → Produtos

Peças vendidas (ex.: camiseta):

1. Nome, SKU/referência, preço de venda
2. O campo **estoque** é somente leitura no cadastro — altere via **Movimentações de estoque**
3. Salvar

### 3.6 Vendas → Pedidos

Fluxo recomendado:

1. **Pedidos** → **Criar**
2. Selecione o **cliente**
3. Escolha o **status** (Pendente, Em Produção ou Finalizado)
4. Selecione o **produto** — aparece o **estoque disponível**
5. Informe a **quantidade** (não pode ser maior que o estoque)
6. O **valor do pedido** é calculado automaticamente (preço × quantidade)
7. Salvar

**Ao finalizar o pedido** (status = Finalizado):

- O sistema cria uma **movimentação de saída** em Estoque
- O estoque do produto é **reduzido**
- Aparece um aviso com link para ver a movimentação

Se mudar o status de Finalizado para outro, a saída é cancelada e o estoque volta.

### 3.7 Estoque → Movimentações

Movimentações manuais ou automáticas (vindas de pedidos finalizados):

| Campo       | Descrição                          |
|-------------|------------------------------------|
| Produto     | Qual item movimentou               |
| Tipo        | Entrada (soma) ou Saída (subtrai)  |
| Quantidade  | Unidades                           |
| Observação  | Motivo (compra, ajuste, pedido…)   |
| Pedido      | Se veio de um pedido finalizado    |

Ao criar uma movimentação manual, o estoque do produto é atualizado na hora.

### 3.8 Governança (somente Admin)

| Módulo        | Função                                      |
|---------------|---------------------------------------------|
| Cargos        | Ex.: Admin, Gerente Comercial + permissões  |
| Permissões    | Chaves: `acessar_clientes`, `acessar_pedidos`, etc. |
| Funcionários  | Usuários do painel e cargo de cada um       |

Usuário **sem cargo** não vê itens no menu.

---

## 4. Fluxos automáticos importantes

### 4.1 Pedido → Estoque (diagrama)

```
Usuário salva pedido com status "Finalizado"
        │
        ▼
EditPedido / CreatePedido (afterSave / afterCreate)
        │
        ▼
PedidoEstoqueService::registrarSaida()
        │
        ├── Valida estoque disponível
        ├── Cria registro em movimentacoes_estoque (tipo: saida)
        └── Model MovimentacaoEstoque (evento created)
                    │
                    ▼
            produto.estoque -= quantidade
```

### 4.2 Validação de estoque no pedido

Antes de salvar (`ValidaEstoquePedido`):

- Compara `quantidade` do pedido com `produto.estoque`
- Se o pedido já tinha saída registrada, soma essa quantidade de volta ao disponível (para permitir edição)

### 4.3 Cálculo do valor total

No model `Pedido`, ao salvar:

```
valor_total = quantidade × produto.preco_venda
```

No formulário, o valor é atualizado ao escolher produto ou quantidade (JavaScript live no Filament).

### 4.4 Máscaras CPF/CNPJ/Telefone

Classe `App\Support\DocumentoBr`:

- Salva no banco **apenas números**
- Exibe no formulário **formatado**
- Regra `DocumentoUnico` impede CPF/CNPJ repetidos

### 4.5 Auditoria (log)

Ao criar ou editar pedidos, grava em `storage/logs/laravel.log`:

- ID do pedido, valor total, e-mail do operador

---

## 5. Segurança e permissões

### 5.1 Cargos padrão (seed)

| Cargo              | Acesso                                              |
|--------------------|-----------------------------------------------------|
| **Admin**          | Tudo + Governança (via `Gate::before` no AppServiceProvider) |
| **Gerente Comercial** | Todos os módulos de negócio (clientes, pedidos, estoque…) |

### 5.2 Permissões de negócio

| Permissão              | Módulo          |
|------------------------|-----------------|
| `acessar_clientes`     | Clientes        |
| `acessar_fornecedores` | Fornecedores    |
| `acessar_insumos`      | Insumos         |
| `acessar_produtos`     | Produtos        |
| `acessar_pedidos`      | Pedidos         |
| `acessar_movimentacoes`| Movimentações   |

Cada `*Resource.php` implementa `canAccess()` usando `FilamentAccess::adminOrPermission(...)`.

### 5.3 Criar novo funcionário

1. Admin → **Governança** → **Funcionários** → Criar
2. Nome, e-mail, senha
3. Atribuir cargo (ex.: Gerente Comercial)
4. Salvar — o usuário já consegue entrar no `/admin`

---

## 6. Como funciona o código

### 6.1 Camadas

```
Navegador (Filament UI)
        │
        ▼
app/Filament/Resources/     ← Telas (formulários, tabelas, páginas)
        │
        ▼
app/Services/               ← Regras de negócio (estoque, notificações)
        │
        ▼
app/Models/                 ← Entidades Eloquent + eventos
        │
        ▼
MySQL
```

### 6.2 Filament — como cada módulo é montado

Cada entidade (ex.: Cliente) segue o padrão:

| Arquivo | Papel |
|---------|--------|
| `ClienteResource.php` | Registra o módulo no menu, ícone, permissão `canAccess()` |
| `Schemas/ClienteForm.php` | Campos do formulário criar/editar |
| `Tables/ClientesTable.php` | Colunas da listagem |
| `Pages/ListClientes.php` | Página da tabela |
| `Pages/CreateCliente.php` | Página de criação |
| `Pages/EditCliente.php` | Página de edição |

O painel é registrado em `app/Providers/Filament/AdminPanelProvider.php`.

### 6.3 Arquivos centrais do pedido + estoque

| Arquivo | Responsabilidade |
|---------|------------------|
| `app/Models/Pedido.php` | Relacionamentos; calcula `valor_total` ao salvar |
| `app/Models/MovimentacaoEstoque.php` | Ao criar/editar/excluir movimentação, ajusta `produto.estoque` |
| `app/Services/PedidoEstoqueService.php` | Cria/cancela saída ligada ao pedido finalizado |
| `app/Filament/Resources/Pedidos/Pages/CreatePedido.php` | Valida estoque; dispara saída se criar já finalizado |
| `app/Filament/Resources/Pedidos/Pages/EditPedido.php` | Guarda status anterior; ao finalizar chama o serviço de estoque |
| `app/Filament/Resources/Pedidos/Concerns/ValidaEstoquePedido.php` | Trait com validação de quantidade vs estoque |

### 6.4 Por que a movimentação é criada nas Pages e não só no Model?

O evento `saved` do Eloquent com `wasChanged('status')` é **pouco confiável** após o save no Filament. Por isso a lógica principal está em:

- `CreatePedido::afterCreate()`
- `EditPedido::afterSave()` + `beforeSave()` (guarda status anterior)

### 6.5 Suporte e regras auxiliares

| Classe | Função |
|--------|--------|
| `App\Support\DocumentoBr` | Formata e limpa CPF, CNPJ, telefone |
| `App\Rules\DocumentoUnico` | Valida documento único no banco |
| `App\Support\FilamentAccess` | Verifica Admin ou permissão Spatie |
| `database/seeders/RolesAndPermissionsSeeder.php` | Cria permissões e cargos iniciais |

---

## 7. Estrutura de pastas

```
confeccaota2/
├── app/
│   ├── Filament/
│   │   ├── Resources/          # Módulos do painel (Cliente, Pedido, etc.)
│   │   └── Widgets/            # Dashboard (estatísticas)
│   ├── Models/                 # Pedido, Produto, Cliente...
│   ├── Services/               # PedidoEstoqueService, PedidoNotifier
│   ├── Support/                # DocumentoBr, FilamentAccess
│   ├── Rules/                  # DocumentoUnico
│   ├── Mail/                   # E-mails (opcional)
│   └── Providers/
│       ├── AppServiceProvider.php      # Gate Admin
│       └── Filament/AdminPanelProvider.php
├── database/
│   ├── migrations/             # Estrutura das tabelas
│   └── seeders/                # Dados iniciais
├── docs/
│   └── DOCUMENTACAO.md         # Este arquivo
├── resources/views/emails/     # Templates de e-mail
└── public/                     # Entrada web (index.php)
```

---

## 8. Banco de dados

### 8.1 Tabelas principais

| Tabela | Descrição |
|--------|-----------|
| `users` | Usuários do painel |
| `clientes` | Clientes (documento único) |
| `fornecedores` | Fornecedores (cnpj único) |
| `insumos` | Materiais |
| `produtos` | Produtos finais + estoque |
| `pedidos` | Pedidos (cliente, produto, quantidade, status, valor_total) |
| `movimentacoes_estoque` | Entradas/saídas (opcional `pedido_id`) |
| `roles`, `permissions`, … | Spatie Permission |

### 8.2 Relacionamentos (resumo)

```
Cliente 1 ── N Pedidos
Produto 1 ── N Pedidos
Pedido  1 ── 0..1 MovimentacaoEstoque
Produto 1 ── N MovimentacoesEstoque
User    N ── N Roles ── N Permissions
```

---

## 9. Comandos úteis

```bash
# Migrations
php artisan migrate
php artisan migrate:fresh --seed   # CUIDADO: apaga tudo e recria

# Dados iniciais (admin + permissões + exemplos)
php artisan db:seed

# Só permissões e cargos
php artisan db:seed --class=RolesAndPermissionsSeeder

# Restaurar cargo Admin em um usuário
php artisan confeccao:ensure-admin admin@confeccao.com

# Limpar cache
php artisan optimize:clear

# Ver rotas do painel
php artisan route:list --path=admin
```

---

## 10. Problemas comuns

### Menu lateral vazio

- Usuário sem cargo ou sem permissão.
- Solução: `php artisan confeccao:ensure-admin` e login com `admin@confeccao.com`.

### Movimentação não criada ao finalizar

- Confirme que o status mudou **para** Finalizado (não só salvou já finalizado sem mudança).
- Produto e quantidade devem estar preenchidos.
- Estoque deve ser suficiente.
- Veja `storage/logs/laravel.log` para erros.

### Erro "documento já cadastrado"

- CPF/CNPJ já existe (comparação só pelos números).
- Use outro documento ou edite o cadastro existente.

### Estoque negativo

- Não deve ocorrer se a validação estiver ativa.
- Confira movimentações duplicadas ou edições manuais no banco.

### Após alterar permissões

Sempre rode: `php artisan optimize:clear`

---

## Resumo rápido do dia a dia

1. Cadastre **produtos** com preço e estoque inicial (via movimentação de entrada).
2. Cadastre **clientes**.
3. Crie **pedidos** respeitando o estoque.
4. Quando a peça estiver pronta, mude o status para **Finalizado** → estoque baixa sozinho.
5. Acompanhe tudo em **Movimentações** e no **Dashboard**.

---

*Documentação gerada para o projeto Confecção TA2 — Laravel + Filament.*
