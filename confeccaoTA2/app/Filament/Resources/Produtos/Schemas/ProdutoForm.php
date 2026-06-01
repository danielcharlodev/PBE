<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProdutoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome do produto')
                    ->required()
                    ->maxLength(255),

                TextInput::make('referencia')
                    ->label('Referência / SKU')
                    ->maxLength(100),

                TextInput::make('preco_venda')
                    ->label('Preço de venda')
                    ->prefix('R$')
                    ->numeric()
                    ->minValue(0)
                    ->required(),

                TextInput::make('estoque')
                    ->label('Estoque atual')
                    ->numeric()
                    ->default(0)
                    ->disabled()
                    ->dehydrated()
                    ->helperText('Use Movimentações de Estoque para alterar a quantidade.'),
            ]);
    }
}
