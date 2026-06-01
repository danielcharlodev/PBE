<?php

namespace App\Filament\Resources\Insumos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InsumosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Insumo')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('unidade_medida')
                    ->label('Unidade')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('preco_custo')
                    ->label('Custo')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('estoque')
                    ->label('Estoque')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
