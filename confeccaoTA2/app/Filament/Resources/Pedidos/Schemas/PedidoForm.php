<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use App\Models\Produto;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PedidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pedido')
                    ->description('O valor é calculado automaticamente. Não é possível pedir mais do que o estoque disponível.')
                    ->columns(2)
                    ->schema([
                        Select::make('cliente_id')
                            ->relationship('cliente', 'nome')
                            ->label('Cliente')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'Pendente' => 'Pendente',
                                'Em Produção' => 'Em Produção',
                                'Finalizado' => 'Finalizado',
                            ])
                            ->default('Pendente')
                            ->required()
                            ->live(),

                        Select::make('produto_id')
                            ->relationship('produto', 'nome')
                            ->label('Produto')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required()
                            ->afterStateUpdated(function (?string $state, Set $set, Get $get): void {
                                self::atualizarValorTotal($set, $state, $get('quantidade'));
                            }),

                        Placeholder::make('estoque_disponivel')
                            ->label('Estoque disponível')
                            ->content(fn (Get $get, $livewire): string => self::textoEstoque($get('produto_id'), $livewire))
                            ->visible(fn (Get $get): bool => filled($get('produto_id'))),

                        TextInput::make('quantidade')
                            ->label('Quantidade')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required()
                            ->live(onBlur: true)
                            ->helperText(fn (Get $get, $livewire): ?string => filled($get('produto_id'))
                                ? 'Máximo: '.self::estoqueDisponivelParaFormulario($get('produto_id'), $livewire).' un.'
                                : null)
                            ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                                self::atualizarValorTotal($set, $get('produto_id'), $state);
                            }),

                        TextInput::make('valor_total')
                            ->label('Valor do pedido')
                            ->prefix('R$')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->default(0)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    private static function estoqueDisponivelParaFormulario(?string $produtoId, mixed $livewire = null): int
    {
        if (! $produtoId) {
            return 0;
        }

        $disponivel = (int) (Produto::query()->find($produtoId)?->estoque ?? 0);

        if (
            is_object($livewire)
            && property_exists($livewire, 'record')
            && $livewire->record?->movimentacaoEstoque
            && (int) $livewire->record->produto_id === (int) $produtoId
        ) {
            $disponivel += (int) $livewire->record->movimentacaoEstoque->quantidade;
        }

        return $disponivel;
    }

    private static function textoEstoque(?string $produtoId, mixed $livewire = null): string
    {
        $qtd = self::estoqueDisponivelParaFormulario($produtoId, $livewire);

        if ($qtd <= 0) {
            return 'Sem estoque';
        }

        return "{$qtd} unidade(s) em estoque";
    }

    private static function atualizarValorTotal(Set $set, ?string $produtoId, mixed $quantidade): void
    {
        if (! $produtoId) {
            $set('valor_total', 0);

            return;
        }

        $produto = Produto::query()->find($produtoId);
        $qtd = max(1, (int) ($quantidade ?? 1));

        $set('valor_total', round((float) ($produto?->preco_venda ?? 0) * $qtd, 2));
    }
}
