<?php

namespace App\Filament\Resources\Fornecedors;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\Fornecedors\Pages\CreateFornecedor;
use App\Filament\Resources\Fornecedors\Pages\EditFornecedor;
use App\Filament\Resources\Fornecedors\Pages\ListFornecedors;
use App\Filament\Resources\Fornecedors\Pages\ViewFornecedor;

// 🧩 Configurações separadas de formulário e visualização
use App\Filament\Resources\Fornecedors\Schemas\FornecedorForm;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorInfolist;

// 📊 Configuração da tabela
use App\Filament\Resources\Fornecedors\Tables\FornecedorsTable;

// 🧱 Model ligado ao banco
use App\Models\Fornecedor;

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

class FornecedorResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = Fornecedor::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Cadastros Gerais';

    // 🔢 Ordem no menu
    protected static ?int $navigationSort = 2;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 🏷️ Nome que aparece no menu
    protected static ?string $navigationLabel = 'Fornecedores';

    // 🧾 Nome singular
    protected static ?string $modelLabel = 'Fornecedor';

    // 🧾 Nome plural
    protected static ?string $pluralModelLabel = 'Fornecedores';

    // 📌 Campo usado como título (vem do banco)
    protected static ?string $recordTitleAttribute = 'nome';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return FornecedorForm::configure($schema)
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

                // 🧾 CNPJ
                TextInput::make('cnpj')
                    ->label('CNPJ'),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return FornecedorInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return FornecedorsTable::configure($table)
            ->columns([
                // 🔎 Nome com busca
                TextColumn::make('nome')->searchable(),

                // 🔎 Email com busca
                TextColumn::make('email')->searchable(),

                // 📱 Telefone
                TextColumn::make('telefone'),

                // 🧾 CNPJ
                TextColumn::make('cnpj'),
            ])
            ->toolbarActions([
                // 🗑️ Deletar vários registros de uma vez
                DeleteBulkAction::make(),
            ]);
    }

    // 🔗 Relacionamentos (ex: pedidos, produtos, etc)
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
            'index' => ListFornecedors::route('/'), // lista
            'create' => CreateFornecedor::route('/create'), // criar
            'view' => ViewFornecedor::route('/{record}'), // visualizar
            'edit' => EditFornecedor::route('/{record}/edit'), // editar
        ];
    }
}