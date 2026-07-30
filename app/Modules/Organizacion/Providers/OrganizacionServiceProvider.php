<?php

declare(strict_types=1);

namespace App\Modules\Organizacion\Providers;

use Illuminate\Support\ServiceProvider;

final class OrganizacionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(
            __DIR__.'/../Presentation/Routes/web.php'
        );

        $this->loadRoutesFrom(
            __DIR__.'/../Presentation/Routes/api.php'
        );

        $this->loadViewsFrom(
            __DIR__.'/../Presentation/Views',
            'organizacion'
        );

        $this->loadMigrationsFrom(
            __DIR__.'/../Infrastructure/Database/Migrations'
        );
    }
}
