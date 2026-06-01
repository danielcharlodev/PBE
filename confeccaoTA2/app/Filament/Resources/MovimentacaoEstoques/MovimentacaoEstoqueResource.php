<?php

namespace App\Filament\Resources\MovimentacaoEstoques;

use App\Filament\Resources\MovimentacaoEstoques\Pages\CreateMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Pages\EditMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Pages\ListMovimentacaoEstoques;
use App\Filament\Resources\MovimentacaoEstoques\Pages\ViewMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Schemas\MovimentacaoEstoqueForm;
use App\Filament\Resources\MovimentacaoEstoques\Schemas\MovimentacaoEstoqueInfolist;
use App\Filament\Resources\MovimentacaoEstoques\Tables\MovimentacaoEstoquesTable;
use App\Models\MovimentacaoEstoque;
use App\Support\FilamentAccess;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MovimentacaoEstoqueResource extends Resource
{
    protected static ?string $model = MovimentacaoEstoque::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPathRoundedSquare;

    protected static ?string $navigationLabel = 'Movimentações';

    protected static ?string $modelLabel = 'movimentação';

    protected static ?string $pluralModelLabel = 'movimentações de estoque';

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return FilamentAccess::adminOrPermission('acessar_movimentacoes');
    }

    public static function form(Schema $schema): Schema
    {
        return MovimentacaoEstoqueForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MovimentacaoEstoqueInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MovimentacaoEstoquesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMovimentacaoEstoques::route('/'),
            'create' => CreateMovimentacaoEstoque::route('/create'),
            'view' => ViewMovimentacaoEstoque::route('/{record}'),
            'edit' => EditMovimentacaoEstoque::route('/{record}/edit'),
        ];
    }
}
