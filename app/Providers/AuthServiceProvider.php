<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Gate::define('customer', fn($user) => in_array($user->role->role_name, ['Customer']));
        Gate::define('guest-home', function (?User $user) { return is_null($user);}); 
        Gate::define('customer-home', function ($user) { return $user->roles_id == 3;});
        Gate::define('isDriver', function ($user) { return $user->roles_id == 2; });
    }
}