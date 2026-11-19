<?php

namespace App\Support;

final class UserRole
{
    public const AQV = 'aqv';

    public const PROFESSOR = 'professor';

    public const PORTARIA = 'portaria';

    public const EQUIPE = [self::PROFESSOR, self::PORTARIA];

    public const AQV_ALIASES = [self::AQV];

    /** E-mails que devem receber perfil AQV automaticamente. */
    public const AQV_EMAILS = [
        'izete@gmail.com',
        'aqv@gmail.com',
    ];

    public static function label(string $role): string
    {
        return match ($role) {
            self::AQV => 'AQV',
            self::PROFESSOR => 'Professor',
            self::PORTARIA => 'Porteiro',
            default => ucfirst($role),
        };
    }

    public static function isAqv(string $role): bool
    {
        return in_array($role, self::AQV_ALIASES, true);
    }

    public static function dashboardRoute(string $role): ?string
    {
        return match ($role) {
            self::AQV => 'aqv.dashboard',
            self::PROFESSOR => 'professor.dashboard',
            self::PORTARIA => 'portaria.dashboard',
            default => null,
        };
    }
}
