<?php

namespace App\Filament\Resources\Pedidos;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\Pedidos\Pages\CreatePedido;
use App\Filament\Resources\Pedidos\Pages\EditPedido;
use App\Filament\Resources\Pedidos\Pages\ListPedidos;
use App\Filament\Resources\Pedidos\Pages\ViewPedido;

// 🧩 Configurações separadas de formulário e visualização
use App\Filament\Resources\Pedidos\Schemas\PedidoForm;
use App\Filament\Resources\Pedidos\Schemas\PedidoInfolist;

// 📊 Configuração da tabela
use App\Filament\Resources\Pedidos\Tables\PedidosTable;

// 🧱 Model ligado ao banco
use App\Models\Pedido;

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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

// 📊 Colunas da tabela
use Filament\Tables\Columns\TextColumn;

// 🔄 Utilitários para manipular estado
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

// 🗑️ Ação de deletar em massa
use Filament\Actions\DeleteBulkAction;

class PedidoResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = Pedido::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Vendas';

    // 🔢 Ordem no menu
    protected static ?int $navigationSort = 1;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 📌 Campo usado como título (vem do banco)
    protected static ?string $recordTitleAttribute = 'id';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return PedidoForm::configure($schema)
            ->schema([
                // 👤 Seleção do cliente
                Select::make('cliente_id')
                    ->relationship('cliente', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Selecione o Cliente'),

                // 🔄 Status do pedido
                Select::make('status')
                    ->options([
                        'Pendente' => 'Pendente',
                        'Em Processo' => 'Em Processo',
                        'Finalizado' => 'Finalizado',
                    ])
                    ->default('Pendente')
                    ->required()
                    ->label('Status'),

                // 💰 Valor total (calculado)
                TextInput::make('valor_total')
                    ->numeric()
                    ->prefix('R$')
                    ->label('Valor Total'),

                // 📦 Itens do pedido
                Repeater::make('itens')
                    ->relationship('itens')
                    ->schema([
                        // 📦 Produto
                        Select::make('produto_id')
                            ->relationship('produto', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Produto')
                            ->columnSpan(2),

                        // 🔢 Quantidade
                        TextInput::make('quantidade')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->label('Quantidade')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Get $get, Set $set, ?int $state) => self::calcularTotal($get, $set))
                            ->columnSpan(1),

                        // 💰 Preço unitário
                        TextInput::make('preco_unitario')
                            ->numeric()
                            ->prefix('R$')
                            ->required()
                            ->label('Preço Unitário')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::calcularTotal($get, $set))
                            ->columnSpan(1),
                    ])
                    ->columns(4)
                    ->columnSpanFull()
                    ->label('Itens do Pedido')
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calcularTotal($get, $set)),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return PedidoInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return PedidosTable::configure($table)
            ->columns([
                // 👤 Cliente
                TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                // 🔄 Status com cor
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Pendente' => 'warning',
                        'Em Processo' => 'info',
                        'Finalizado' => 'success',
                        default => 'gray',
                    }),

                // 💰 Valor total
                TextColumn::make('valor_total')
                    ->label('Valor Total')
                    ->money('BRL')
                    ->sortable(),

                // 📅 Data do pedido
                TextColumn::make('created_at')
                    ->label('Data do Pedido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                // vazio
            ])
            ->toolbarActions([
                // 🗑️ Deletar vários registros
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
            'index' => ListPedidos::route('/'), // lista
            'create' => CreatePedido::route('/create'), // criar
            'view' => ViewPedido::route('/{record}'), // visualizar
            'edit' => EditPedido::route('/{record}/edit'), // editar
        ];
    }

    // 🧠 FUNÇÃO: calcula o valor total do pedido
    public static function calcularTotal(Get $get, Set $set): void
    {
        $itens = $get('itens') ?? [];
        $total = 0;

        foreach ($itens as $item) {
            $quantidade = (float) ($item['quantidade'] ?? 0);
            $precoUnitario = (float) ($item['preco_unitario'] ?? 0);
            $total += $quantidade * $precoUnitario;
        }

        // 💰 Atualiza o campo automaticamente
        $set('valor_total', number_format($total, 2, '.', ''));
    }
}