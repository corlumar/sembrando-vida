<?php

declare(strict_types=1);

namespace App\Core\Providers;

use App\Core\Builders\ModuleBuilder;
use App\Core\Contracts\ModuleBuilderContract;
use App\Core\Contracts\ERPKernelContract;
use App\Core\Contracts\FileWriterContract;
use App\Core\Contracts\JsonWriterContract;
use App\Core\Contracts\StubWriterContract;
use App\Core\Contracts\GitKeepGeneratorContract;
use App\Core\FileSystem\GitKeepGenerator;
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

                $this->app->singleton(
            GitKeepGeneratorContract::class,
            GitKeepGenerator::class
        );

        $this->app->singleton(
    ModuleBuilderContract::class,
    function ($app): ModuleBuilder {
        return new ModuleBuilder(
            directories: $app->make(
                \App\Core\FileSystem\DirectoryManager::class
            ),
            json: $app->make(
                \App\Core\Contracts\JsonWriterContract::class
            ),
            stubs: $app->make(
                \App\Core\Contracts\StubWriterContract::class
            ),
            gitKeep: $app->make(
                \App\Core\Contracts\GitKeepGeneratorContract::class
            ),
            modulesPath: (string) config(
                'erp.modules_path',
                app_path('Modules')
            ),
            templatesPath: app_path(
                'Core/Templates/module'
            )
        );
    }
);
    }

    public function boot(ERPKernelContract $kernel): void
    {
        $kernel->boot();
    }
}