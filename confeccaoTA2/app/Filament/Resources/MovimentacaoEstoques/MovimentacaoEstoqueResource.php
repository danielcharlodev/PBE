<?php

namespace App\Filament\Resources\MovimentacaoEstoques;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\MovimentacaoEstoques\Pages\CreateMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Pages\EditMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Pages\ListMovimentacaoEstoques;
use App\Filament\Resources\MovimentacaoEstoques\Pages\ViewMovimentacaoEstoque;

// 🧱 Model ligado ao banco
use App\Models\MovimentacaoEstoque;

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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

// 📊 Colunas da tabela
use Filament\Tables\Columns\TextColumn;

class MovimentacaoEstoqueResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = MovimentacaoEstoque::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    // 🔢 Ordem no menu
    protected static ?int $navigationSort = 3;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 🏷️ Nome no menu
    protected static ?string $navigationLabel = 'Movimentação dos Estoques';

    // 🧾 Nome plural
    protected static ?string $pluralModelLabel = 'Movimentação dos Estoques';

    // 📌 Campo usado como título (vem do banco)
    protected static ?string $recordTitleAttribute = 'id';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // 📦 Seleção do produto (relacionamento)
                Select::make('produto_id')
                    ->relationship('produto', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Selecione o Produto')
                    ->columnSpanFull(),

                // 🔄 Tipo da movimentação
                Select::make('tipo')
                    ->label('Tipo de Movimentação')
                    ->options([
                        'entrada' => 'Entrada (Adicionar ao Estoque)',
                        'saida' => 'Saída (Retirar do Estoque)',
                    ])
                    ->required()
                    ->native(false),

                // 🔢 Quantidade
                TextInput::make('quantidade')
                    ->label('Quantidade')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->helperText('Apenas números inteiros positivos (ex: 10).'),

                // 📝 Observação
                TextInput::make('observacao')
                    ->label('Observação / Motivo')
                    ->maxLength(255)
                    ->placeholder('Ex: Compra do fornecedor, devolução, ajuste manual...')
                    ->columnSpanFull(),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return \App\Filament\Resources\MovimentacaoEstoques\Schemas\MovimentacaoEstoqueInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 📅 Data da movimentação
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                // 📦 Produto (relacionamento)
                TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),

                // 🔄 Tipo com cor
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'entrada' => 'success',
                        'saida' => 'danger',
                    }),

                // 🔢 Quantidade
                TextColumn::make('quantidade')
                    ->label('Qtd')
                    ->numeric()
                    ->sortable(),

                // 📝 Observação
                TextColumn::make('observacao')
                    ->label('Observação')
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // vazio por enquanto
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
            'index' => ListMovimentacaoEstoques::route('/'), // lista
            'create' => CreateMovimentacaoEstoque::route('/create'), // criar
            'view' => ViewMovimentacaoEstoque::route('/{record}'), // visualizar
            'edit' => EditMovimentacaoEstoque::route('/{record}/edit'), // editar
        ];
    }
}