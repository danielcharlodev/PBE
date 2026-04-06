<?php

namespace App\Filament\Resources\Users;

// 📄 Páginas do CRUD (listar, criar, editar, visualizar)
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;

// 🧩 Configurações separadas de formulário e visualização
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;

// 📊 Configuração da tabela
use App\Filament\Resources\Users\Tables\UsersTable;

// 🧱 Model ligado ao banco
use App\Models\User;

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

class UserResource extends Resource
{
    // 🔗 Model que esse CRUD usa
    protected static ?string $model = User::class;

    // 📂 Grupo no menu lateral
    protected static string|UnitEnum|null $navigationGroup = 'Administração';

    // 🔢 Ordem no menu
    protected static ?int $navigationSort = 0;

    // 🎨 Ícone do menu
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 🏷️ Nome que aparece no menu
    protected static ?string $navigationLabel = 'Painel de Usuários';

    // 🧾 Nome singular
    protected static ?string $modelLabel = 'Usuário';

    // 🧾 Nome plural
    protected static ?string $pluralModelLabel = 'Usuários';

    // 📌 Campo usado como título (vem do banco)
    protected static ?string $recordTitleAttribute = 'name';

    // 🧩 FORMULÁRIO (criar/editar)
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // 👤 Cargo (roles)
                Select::make('roles')
                    ->label('Cargo')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload()
                    ->columnSpanFull(),

                // 🧑 Nome do usuário
                TextInput::make('name')
                    ->label('Nome de Usuario')
                    ->required(),

                // 📧 Email
                TextInput::make('email')
                    ->label('Endereço de Email')
                    ->email()
                    ->required(),

                // 🔒 Senha
                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required(),
            ]);
    }

    // 👁️ TELA DE VISUALIZAÇÃO (view)
    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    // 📊 TABELA (listagem dos dados)
    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'), // lista
            'create' => CreateUser::route('/create'), // criar
            'view' => ViewUser::route('/{record}'), // visualizar
            'edit' => EditUser::route('/{record}/edit'), // editar
        ];
    }
}