<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use App\Models\Fornecedor;
use App\Rules\DocumentoUnico;
use App\Support\DocumentoBr;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class FornecedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Razão social / Nome')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->maxLength(255),

                TextInput::make('telefone')
                    ->label('Telefone comercial')
                    ->tel()
                    ->mask('(99) 99999-9999')
                    ->placeholder('(11) 3333-0000')
                    ->dehydrateStateUsing(fn (?string $state): ?string => DocumentoBr::apenasDigitos($state))
                    ->formatStateUsing(fn (?string $state): ?string => DocumentoBr::formatarTelefone($state))
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (?string $state, Set $set) => $set('telefone', DocumentoBr::formatarTelefone($state))),

                TextInput::make('cnpj')
                    ->label('CNPJ')
                    ->required()
                    ->mask('99.999.999/9999-99')
                    ->placeholder('00.000.000/0000-00')
                    ->dehydrateStateUsing(fn (?string $state): ?string => DocumentoBr::apenasDigitos($state))
                    ->formatStateUsing(fn (?string $state): ?string => DocumentoBr::formatar($state))
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (?string $state, Set $set) => $set('cnpj', DocumentoBr::formatar($state)))
                    ->rules(fn ($record) => [
                        'required',
                        new DocumentoUnico(Fornecedor::class, 'cnpj', $record?->id),
                    ]),
            ]);
    }
}
