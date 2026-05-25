<?php

namespace App\Http\Controllers;

use App\Services\UserRoleNormalizer;
use App\Support\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct(
        private UserRoleNormalizer $roleNormalizer
    ) {}

    public function __invoke(): RedirectResponse
    {
        $user = $this->roleNormalizer->normalize(Auth::user());

        $route = UserRole::dashboardRoute($user->role);

        if ($route === null) {
            return redirect()
                ->route('login')
                ->with('error', 'Seu usuário não possui cargo definido. Contate a administração.');
        }

        return redirect()->route($route);
    }
}
