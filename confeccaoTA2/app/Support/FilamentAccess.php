<?php

namespace App\Support;

use App\Models\User;

class FilamentAccess
{
    public static function user(): ?User
    {
        $user = auth()->user();

        return $user instanceof User ? $user : null;
    }

    public static function isAdmin(): bool
    {
        $user = self::user();

        return $user !== null && $user->hasRole('Admin');
    }

    public static function adminOnly(): bool
    {
        return self::isAdmin();
    }

    public static function adminOrPermission(string $permission): bool
    {
        $user = self::user();

        if ($user === null) {
            return false;
        }

        if ($user->hasRole('Admin')) {
            return true;
        }

        return $user->can($permission);
    }
}
