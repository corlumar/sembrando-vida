<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // Gate para controlar la gestión de usuarios desde las vistas
        Gate::define('manage-users', function (?User $user) {
            if (! $user) return false;
            return optional($user->role)->name === 'Administrativo';
        });
    }
}
