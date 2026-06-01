<?php

namespace App\Filament\Resources\MovimentacaoEstoques\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MovimentacaoEstoquesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pedido.id')
                    ->label('Pedido')
                    ->formatStateUsing(fn (?int $state): string => $state ? "#{$state}" : '—')
                    ->sortable(),

                TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'entrada' ? 'Entrada' : 'Saída')
                    ->color(fn (string $state): string => $state === 'entrada' ? 'success' : 'danger'),

                TextColumn::make('quantidade')
                    ->label('Quantidade')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('observacao')
                    ->label('Observação')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
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
