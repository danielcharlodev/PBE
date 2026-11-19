<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InsumoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome do insumo')
                    ->required()
                    ->maxLength(255),

                Select::make('unidade_medida')
                    ->label('Unidade de medida')
                    ->options([
                        'Metros' => 'Metros',
                        'Kg' => 'Quilogramas (Kg)',
                        'Unidade' => 'Unidade',
                        'Cone' => 'Cone',
                        'Rolo' => 'Rolo',
                    ])
                    ->searchable()
                    ->required(),

                TextInput::make('preco_custo')
                    ->label('Preço de custo')
                    ->prefix('R$')
                    ->numeric()
                    ->minValue(0),

                TextInput::make('estoque')
                    ->label('Estoque')
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
            ]);
    }
}
