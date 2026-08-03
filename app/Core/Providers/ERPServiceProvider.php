<?php

declare(strict_types=1);

namespace App\Core\Providers;

use App\Core\Contracts\ERPKernelContract;
use App\Core\Contracts\FileWriterContract;
use App\Core\Contracts\JsonWriterContract;
use App\Core\Contracts\StubWriterContract;
use App\Core\FileSystem\StubWriter;
use App\Core\FileSystem\FileWriter;
use App\Core\FileSystem\JsonWriter;
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

        $this->app->singleton(
            FileWriterContract::class,
            FileWriter::class
        );

        $this->app->singleton(
            JsonWriterContract::class,
            JsonWriter::class
        );

        $this->app->singleton(
            StubWriterContract::class,
            StubWriter::class
);
    }

    public function boot(ERPKernelContract $kernel): void
    {
        $kernel->boot();
    }
}