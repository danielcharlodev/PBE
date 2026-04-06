<?php

namespace App\Filament\Resources\Produtos;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\Produtos\Pages\CreateProduto;
use App\Filament\Resources\Produtos\Pages\EditProduto;
use App\Filament\Resources\Produtos\Pages\ListProdutos;
use App\Filament\Resources\Produtos\Pages\ViewProduto;

// 🧩 Configurações separadas de formulário e visualização
use App\Filament\Resources\Produtos\Schemas\ProdutoForm;
use App\Filament\Resources\Produtos\Schemas\ProdutoInfolist;

// 📊 Configuração da tabela
use App\Filament\Resources\Produtos\Tables\ProdutosTable;

// 🧱 Model ligado ao banco
use App\Models\Produto;

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

class ProdutoResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = Produto::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    // 🔢 Ordem no menu
    protected static ?int $navigationSort = 2;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 📌 Campo usado como título (vem do banco)
    protected static ?string $recordTitleAttribute = 'nome';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return ProdutoForm::configure($schema)
            ->schema([
                // 🏷️ Nome do produto
                TextInput::make('nome')
                    ->required()
                    ->label('Nome do Produto'),

                // 🔢 Código de referência
                TextInput::make('referencia')
                    ->label('Código de Referência'),

                // 💰 Preço de venda
                TextInput::make('preco_venda')
                    ->prefix('R$')
                    ->label('Preço de Venda'),

                // 📦 Estoque
                TextInput::make('estoque')
                    ->default(0)
                    ->label('Estoque'),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return ProdutoInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return ProdutosTable::configure($table)
            ->columns([
                // 🔎 Nome com busca
                TextColumn::make('nome')->searchable(),

                // 🔢 Referência
                TextColumn::make('referencia'),

                // 💰 Preço
                TextColumn::make('preco_venda')->money('BRL'),

                // 📦 Estoque
                TextColumn::make('estoque'),
            ])
            ->toolbarActions([
                // 🗑️ Deletar em massa
                DeleteBulkAction::make(),
            ]);
    }

    // 🔗 Relacionamentos
    public static function getRelations(): array
    {
        return [
            // vazio
        ];
    }

    // 📄 ROTAS das páginas
    public static function getPages(): array
    {
        return [
            'index' => ListProdutos::route('/'), // lista
            'create' => CreateProduto::route('/create'), // criar
            'view' => ViewProduto::route('/{record}'), // visualizar
            'edit' => EditProduto::route('/{record}/edit'), // editar
        ];
    }
}