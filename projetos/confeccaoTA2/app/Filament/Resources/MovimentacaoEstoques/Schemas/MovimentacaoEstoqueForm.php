<?php

namespace App\Filament\Resources\MovimentacaoEstoques\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MovimentacaoEstoqueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produto_id')
                    ->relationship('produto', 'nome')
                    ->label('Produto')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'entrada' => 'Entrada',
                        'saida' => 'Saída',
                    ])
                    ->required(),

                TextInput::make('quantidade')
                    ->label('Quantidade')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                TextInput::make('observacao')
                    ->label('Observação')
                    ->placeholder('Ex.: compra, ajuste, devolução')
                    ->maxLength(255),
            ]);
    }
}
