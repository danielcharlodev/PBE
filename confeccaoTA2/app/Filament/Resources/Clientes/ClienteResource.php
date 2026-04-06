<?php

namespace App\Filament\Resources\Clientes;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\Clientes\Pages\CreateCliente;
use App\Filament\Resources\Clientes\Pages\EditCliente;
use App\Filament\Resources\Clientes\Pages\ListClientes;
use App\Filament\Resources\Clientes\Pages\ViewCliente;

// 🧩 Configurações separadas de formulário e visualização
use App\Filament\Resources\Clientes\Schemas\ClienteForm;
use App\Filament\Resources\Clientes\Schemas\ClienteInfolist;

// 📊 Configuração da tabela
use App\Filament\Resources\Clientes\Tables\ClientesTable;

// 🧱 Model ligado ao banco
use App\Models\Cliente;

// ⚙️ Tipagem
use BackedEnum;
use UnitEnum;

// 🧩 Base do Filament
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

// 🎨 Ícones
use Filament\Support\Icons\Heroicon;

// 🧾 Inputs do formulário
use Filament\Forms\Components\TextInput;

// 📊 Colunas da tabela
use Filament\Tables\Columns\TextColumn;

// 🗑️ Ação de deletar em massa
use Filament\Actions\DeleteBulkAction;

class ClienteResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = Cliente::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Cadastros Gerais';

    // 🔢 Ordem no menu
    protected static ?int $navigationSort = 1;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 🏷️ Nome que aparece no menu
    protected static ?string $navigationLabel = 'Clientes';

    // 🧾 Nome singular
    protected static ?string $modelLabel = 'Cliente';

    // 🧾 Nome plural
    protected static ?string $pluralModelLabel = 'Clientes';

    // 📌 Campo usado como título (vem do banco)
    protected static ?string $recordTitleAttribute = 'nome';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return ClienteForm::configure($schema)
            ->schema([
                // 📝 Nome obrigatório
                TextInput::make('nome')
                    ->required()
                    ->label('Nome Completo'),

                // 📧 Email com validação de formato
                TextInput::make('email')
                    ->email()
                    ->label('E-mail'),

                // 📱 Telefone (tipo tel)
                TextInput::make('telefone')
                    ->tel()
                    ->label('Telefone'),

                // 🧾 Documento (CPF ou CNPJ)
                TextInput::make('documento')
                    ->label('CPF ou CNPJ'),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return ClienteInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return ClientesTable::configure($table)
            ->columns([
                // 🔎 Nome com busca
                TextColumn::make('nome')->searchable(),

                // 🔎 Email com busca
                TextColumn::make('email')->searchable(),

                // 📱 Telefone
                TextColumn::make('telefone'),

                // 🧾 Documento
                TextColumn::make('documento'),
            ])
            ->toolbarActions([
                // 🗑️ Deletar vários registros de uma vez
                DeleteBulkAction::make(),
            ]);
    }

    // 🔗 Relacionamentos (ex: pedidos, etc)
    public static function getRelations(): array
    {
        return [
            // vazio por enquanto
        ];
    }

    // 📄 ROTAS das páginas
    public static function getPages(): array
    {
        return [
            'index' => ListClientes::route('/'), // lista
            'create' => CreateCliente::route('/create'), // criar
            'view' => ViewCliente::route('/{record}'), // visualizar
            'edit' => EditCliente::route('/{record}/edit'), // editar
        ];
    }
}