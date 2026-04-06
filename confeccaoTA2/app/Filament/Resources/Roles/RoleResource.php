<?php

namespace App\Filament\Resources\Roles;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Pages\ViewRole;

// 🧩 Configuração da visualização
use App\Filament\Resources\Roles\Schemas\RoleInfolist;

// 🧱 Model ligado ao banco (Spatie Permission)
use Spatie\Permission\Models\Role;

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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

// 📊 Colunas da tabela
use Filament\Tables\Columns\TextColumn;

class RoleResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = Role::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Administração';

    // 🔢 Ordem no menu (fica no topo)
    protected static ?int $navigationSort = 3;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 📌 Campo usado como título
    protected static ?string $recordTitleAttribute = 'name';

    // 🧾 Nome singular
    protected static ?string $modelLabel = 'Cargo';

    // 🧾 Nome plural
    protected static ?string $pluralModelLabel = 'Cargos e Funções';

    // 🏷️ Nome no menu
    protected static ?string $navigationLabel = 'Cargos e Funções';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // 🔐 Permissões vinculadas ao cargo
                Select::make('permissions')
                    ->label('Permissões de Acesso')
                    ->multiple()
                    ->relationship('permissions', 'name')
                    ->preload()
                    ->columnSpanFull(),

                // 🏷️ Nome do cargo
                TextInput::make('name')
                    ->label('Nome do Cargo')
                    ->required(),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return RoleInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🏷️ Nome do cargo
                TextColumn::make('name')
                    ->label('Liberação de Menu')
                    ->searchable()
                    ->sortable(),

                // 🔐 Permissões (badge)
                TextColumn::make('permissions.name')
                    ->label('Permissões de Acesso')
                    ->badge()
                    ->separator(', '),
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
            'index' => ListRoles::route('/'), // lista
            'create' => CreateRole::route('/create'), // criar
            'view' => ViewRole::route('/{record}'), // visualizar
            'edit' => EditRole::route('/{record}/edit'), // editar
        ];
    }
}