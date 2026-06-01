<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PedidoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('cliente.nome')
                            ->label('Cliente'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge(),

                        TextEntry::make('produto.nome')
                            ->label('Produto'),

                        TextEntry::make('quantidade')
                            ->label('Quantidade'),

                        TextEntry::make('valor_total')
                            ->label('Valor do pedido')
                            ->money('BRL')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}
