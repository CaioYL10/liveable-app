<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function ($user) {
            return (bool) $user->role == 'admin';
        });
        Gate::define('adminOrOwner', function ($user) {
            return (bool) $user->role == 'owner' || $user->role === 'admin';
        });
    }
}
