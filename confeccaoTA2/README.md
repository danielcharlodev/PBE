# ERP Confecção TA2

Sistema de gestão para confecção desenvolvido com **Laravel 13** e **Filament 5**.

## Funcionalidades

- Cadastro de clientes, fornecedores, insumos e produtos
- Pedidos com cálculo automático de valor
- Movimentação de estoque (entrada/saída) com atualização automática do saldo
- Baixa de estoque automática ao **finalizar** pedido
- Validação de estoque insuficiente
- Máscaras para CPF, CNPJ e telefone + bloqueio de documentos duplicados
- Controle de acesso (RBAC) com cargos e permissões

## Início rápido

```bash
composer install
copy .env.example .env
php artisan key:generate
# Configure DB_* no .env e crie o banco MySQL
php artisan migrate
php artisan db:seed
php artisan serve
```

Acesse: **http://127.0.0.1:8000/admin**

| Login | Valor |
|-------|--------|
| E-mail | `admin@confeccao.com` |
| Senha | `password` |

## Documentação completa

Passo a passo de instalação, uso do sistema e explicação de como o código funciona:

**[docs/DOCUMENTACAO.md](docs/DOCUMENTACAO.md)**

## Licença

MIT
