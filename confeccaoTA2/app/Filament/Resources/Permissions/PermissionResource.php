<?php

namespace App\Filament\Resources\Permissions;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\Permissions\Pages\CreatePermission;
use App\Filament\Resources\Permissions\Pages\EditPermission;
use App\Filament\Resources\Permissions\Pages\ListPermissions;
use App\Filament\Resources\Permissions\Pages\ViewPermission;

// 🧩 Configurações separadas de formulário e visualização
use App\Filament\Resources\Permissions\Schemas\PermissionForm;
use App\Filament\Resources\Permissions\Schemas\PermissionInfolist;

// 📊 Configuração da tabela
use App\Filament\Resources\Permissions\Tables\PermissionsTable;

// 🧱 Model ligado ao banco (Spatie)
use Spatie\Permission\Models\Permission;

// ⚙️ Tipagem
use BackedEnum;
use UnitEnum;

// 🧩 Base do Filament
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

// 🎨 Ícones
use Filament\Support\Icons\Heroicon;

// 🧾 Inputs do formulário
use Filament\Forms\Components\TextInput;

// 📊 Colunas da tabela
use Filament\Tables\Columns\TextColumn;

// 🗑️ Ação de deletar em massa
use Filament\Actions\DeleteBulkAction;

class PermissionResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = Permission::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Administração';

    // 🔢 Ordem no menu
    protected static ?int $navigationSort = 1;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 🏷️ Nome que aparece no menu
    protected static ?string $navigationLabel = 'Painel de Permissões';

    // 🧾 Nome singular
    protected static ?string $modelLabel = 'Permissão';

    // 🧾 Nome plural
    protected static ?string $pluralModelLabel = 'Permissões';

    // 📌 Campo usado como título (vem do banco)
    protected static ?string $recordTitleAttribute = 'name';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return PermissionForm::configure($schema)
            ->schema([
                // 🏷️ Nome da permissão
                TextInput::make('name')
                    ->label('Nome da Regra')
                    ->required(),

                // 🔐 Guard (geralmente web/api)
                TextInput::make('web')
                    ->label('Sigla da Regra'),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return PermissionInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return PermissionsTable::configure($table)
            ->columns([
                // 🏷️ Nome
                TextColumn::make('name')
                    ->label('Nome da Regra')
                    ->searchable()
                    ->sortable(),

                // 🔐 Guard
                TextColumn::make('guard_name')
                    ->label('Sigla da Regra')
                    ->searchable()
                    ->sortable(),
            ])
            ->toolbarActions([
                // 🗑️ Deletar em massa
                DeleteBulkAction::make(),
            ]);
    }

    // 🔗 Relacionamentos
    public static function getRelations(): array
    {
        return [
            // vazio
        ];
    }

    // 📄 ROTAS das páginas
    public static function getPages(): array
    {
        return [
            'index' => ListPermissions::route('/'), // lista
            'create' => CreatePermission::route('/create'), // criar
            'view' => ViewPermission::route('/{record}'), // visualizar
            'edit' => EditPermission::route('/{record}/edit'), // editar
        ];
    }
}