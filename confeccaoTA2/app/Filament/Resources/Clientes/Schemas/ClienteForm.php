<?php

namespace App\Filament\Resources\Clientes\Schemas;

use App\Models\Cliente;
use App\Rules\DocumentoUnico;
use App\Support\DocumentoBr;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome completo')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->maxLength(255),

                TextInput::make('telefone')
                    ->label('WhatsApp / Telefone')
                    ->tel()
                    ->mask('(99) 99999-9999')
                    ->placeholder('(11) 99999-9999')
                    ->dehydrateStateUsing(fn (?string $state): ?string => DocumentoBr::apenasDigitos($state))
                    ->formatStateUsing(fn (?string $state): ?string => DocumentoBr::formatarTelefone($state))
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (?string $state, Set $set) => $set('telefone', DocumentoBr::formatarTelefone($state))),

                TextInput::make('documento')
                    ->label('CPF ou CNPJ')
                    ->required()
                    ->placeholder('000.000.000-00 ou 00.000.000/0000-00')
                    ->dehydrateStateUsing(fn (?string $state): ?string => DocumentoBr::apenasDigitos($state))
                    ->formatStateUsing(fn (?string $state): ?string => DocumentoBr::formatar($state))
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (?string $state, Set $set) => $set('documento', DocumentoBr::formatar($state)))
                    ->rules(fn ($record) => [
                        'required',
                        new DocumentoUnico(Cliente::class, 'documento', $record?->id),
                    ]),
            ]);
    }
}
