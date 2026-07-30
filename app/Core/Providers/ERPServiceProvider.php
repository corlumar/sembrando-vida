<?php

declare(strict_types=1);

namespace App\Core\Providers;

use App\Core\Contracts\ERPKernelContract;
use App\Core\Kernel\ERPKernel;
use Illuminate\Support\ServiceProvider;

final class ERPServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            config_path('erp.php'),
            'erp'
        );

        $this->app->singleton(
            ERPKernelContract::class,
            function ($app): ERPKernel {
                return new ERPKernel(
                    app: $app,
                    files: $app->make('files'),
                );
            }
        );

        $this->app->alias(
            ERPKernelContract::class,
            ERPKernel::class
        );
    }

    public function boot(ERPKernelContract $kernel): void
    {
        $kernel->boot();
    }
}
