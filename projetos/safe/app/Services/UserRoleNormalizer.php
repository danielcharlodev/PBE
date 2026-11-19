<?php

namespace App\Services;

use App\Models\User;
use App\Support\UserRole;

class UserRoleNormalizer
{
    public function normalize(User $user): User
    {
        $updates = [];

        if (
            in_array($user->email, UserRole::AQV_EMAILS, true)
            && ($user->role ?? '') !== UserRole::AQV
        ) {
            $updates['role'] = UserRole::AQV;
            $updates['ativo'] = true;
        }

        if ($updates !== []) {
            $user->update($updates);
            $user->refresh();
        }

        return $user;
    }
}
