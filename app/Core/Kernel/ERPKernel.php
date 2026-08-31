<?php

declare(strict_types=1);

namespace App\Core\Kernel;

use App\Core\Contracts\ERPKernelContract;
use App\Core\Exceptions\InvalidModuleManifestException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\Filesystem;
use JsonException;
use Throwable;

final class ERPKernel implements ERPKernelContract
{
    /**
     * @var array<string, array<string, mixed>>
     */
    private array $modules = [];

    private bool $booted = false;

    public function __construct(
        private readonly Application $app,
        private readonly Filesystem $files,
    ) {
    }

    public function boot(): void
    {
        if ($this->booted) {
            return;
        }

        if ((bool) config('erp.auto_discovery', true)) {
            $this->discoverModules();
        }

        $this->booted = true;
    }

    public function discoverModules(): void
    {
        $modulesPath = (string) config(
            'erp.modules_path',
            app_path('Modules')
        );

        if (! $this->files->isDirectory($modulesPath)) {
            return;
        }

        foreach ($this->files->directories($modulesPath) as $modulePath) {
            try {
                $manifest = $this->readManifest($modulePath);

                if ($manifest === null) {
                    continue;
                }

                if (! $this->isEnabled($manifest)) {
                    continue;
                }

                $this->registerModule($manifest, $modulePath);
            } catch (Throwable $exception) {
                $this->app->make('log')->error(
                    'No fue posible registrar un módulo del ERP.',
                    [
                        'module_path' => $modulePath,
                        'exception' => $exception->getMessage(),
                    ]
                );
            }
        }

        ksort($this->modules);
    }

    public function modules(): array
    {
        return $this->modules;
    }

    public function hasModule(string $name): bool
    {
        return isset($this->modules[$name]);
    }

    /**
     * @return array<string, mixed>|null
     */
    private function readManifest(string $modulePath): ?array
    {
        $manifestName = (string) config('erp.manifest', 'module.json');
        $manifestPath = $modulePath.DIRECTORY_SEPARATOR.$manifestName;

        if (! $this->files->exists($manifestPath)) {
            return null;
        }

        try {
            $manifest = json_decode(
                $this->files->get($manifestPath),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (JsonException $exception) {
            throw new InvalidModuleManifestException(
                "El manifiesto {$manifestPath} contiene JSON inválido.",
                previous: $exception
            );
        }

        if (! is_array($manifest)) {
            throw new InvalidModuleManifestException(
                "El manifiesto {$manifestPath} debe contener un objeto JSON."
            );
        }

        $this->validateManifest($manifest, $manifestPath);

        return $manifest;
    }

    /**
     * @param array<string, mixed> $manifest
     */
    private function validateManifest(
        array $manifest,
        string $manifestPath
    ): void {
        foreach (['name', 'version', 'provider'] as $requiredField) {
            if (
                ! isset($manifest[$requiredField])
                || ! is_string($manifest[$requiredField])
                || trim($manifest[$requiredField]) === ''
            ) {
                throw new InvalidModuleManifestException(
                    "El manifiesto {$manifestPath} no contiene el campo válido ".
                    "\"{$requiredField}\"."
                );
            }
        }
    }

    /**
     * @param array<string, mixed> $manifest
     */
    private function isEnabled(array $manifest): bool
    {
        return (bool) ($manifest['enabled'] ?? true);
    }

    /**
     * @param array<string, mixed> $manifest
     */
    private function registerModule(
        array $manifest,
        string $modulePath
    ): void {
        $name = trim((string) $manifest['name']);
        $provider = trim((string) $manifest['provider']);

        if (isset($this->modules[$name])) {
            throw new InvalidModuleManifestException(
                "El módulo {$name} está registrado más de una vez."
            );
        }

        if (! class_exists($provider)) {
            throw new InvalidModuleManifestException(
                "El Service Provider {$provider} del módulo {$name} no existe."
            );
        }

        $manifest['path'] = $modulePath;

        $this->app->register($provider);

        $this->modules[$name] = $manifest;
    }
}
