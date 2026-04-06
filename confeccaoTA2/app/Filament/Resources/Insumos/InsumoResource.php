<?php

namespace App\Filament\Resources\Insumos;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\Insumos\Pages\CreateInsumo;
use App\Filament\Resources\Insumos\Pages\EditInsumo;
use App\Filament\Resources\Insumos\Pages\ListInsumos;
use App\Filament\Resources\Insumos\Pages\ViewInsumo;

// 🧩 Configurações separadas de formulário e visualização
use App\Filament\Resources\Insumos\Schemas\InsumoForm;
use App\Filament\Resources\Insumos\Schemas\InsumoInfolist;

// 📊 Configuração da tabela
use App\Filament\Resources\Insumos\Tables\InsumosTable;

// 🧱 Model ligado ao banco
use App\Models\Insumo;

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

class InsumoResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = Insumo::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    // 🔢 Ordem no menu
    protected static ?int $navigationSort = 1;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 📌 Campo usado como título (vem do banco)
    protected static ?string $recordTitleAttribute = 'nome';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return InsumoForm::configure($schema)
            ->schema([
                // 📝 Nome obrigatório
                TextInput::make('nome')
                    ->required()
                    ->label('Nome do Insumo'),

                // 📦 Unidade de medida
                TextInput::make('unidade_medida')
                    ->required()
                    ->label('Unidade de Medida'),

                // 💰 Preço de custo
                TextInput::make('preco_custo')
                    ->numeric()
                    ->prefix('R$')
                    ->label('Preço de Custo'),

                // 📊 Estoque
                TextInput::make('estoque')
                    ->numeric()
                    ->label('Estoque')
                    ->default(0),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return InsumoInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return InsumosTable::configure($table)
            ->columns([
                // 🔎 Nome com busca
                TextColumn::make('nome')->searchable(),

                // 📦 Unidade de medida
                TextColumn::make('unidade_medida'),

                // 💰 Preço formatado em real
                TextColumn::make('preco_custo')->money('BRL'),

                // 📊 Estoque
                TextColumn::make('estoque'),
            ])
            ->toolbarActions([
                // 🗑️ Deletar vários registros de uma vez
                DeleteBulkAction::make(),
            ]);
    }

    // 🔗 Relacionamentos (ex: fornecedores, produtos, etc)
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
            'index' => ListInsumos::route('/'), // lista
            'create' => CreateInsumo::route('/create'), // criar
            'view' => ViewInsumo::route('/{record}'), // visualizar
            'edit' => EditInsumo::route('/{record}/edit'), // editar
        ];
    }
}