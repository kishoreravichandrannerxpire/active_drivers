<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Example gates
        Gate::define('permissions', fn($user) => $user->role->role_name === 'Admin');
        Gate::define('dashboard-rest', fn($user) => in_array($user->role->role_name, ['Admin', 'Anonymous']));
    }
}
