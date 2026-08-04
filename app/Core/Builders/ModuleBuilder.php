<?php

declare(strict_types=1);

namespace App\Core\Builders;

use App\Core\Contracts\GitKeepGeneratorContract;
use App\Core\Contracts\JsonWriterContract;
use App\Core\Contracts\ModuleBuilderContract;
use App\Core\Contracts\StubWriterContract;
use App\Core\FileSystem\DirectoryManager;
use Illuminate\Support\Str;
use InvalidArgumentException;
use RuntimeException;

final class ModuleBuilder implements ModuleBuilderContract
{
    /**
     * @var array<int, string>
     */
    private const DIRECTORIES = [
        'Application/Commands',
        'Application/DTOs',
        'Application/Queries',
        'Application/Services',
        'Domain/Entities',
        'Domain/Events',
        'Domain/Exceptions',
        'Domain/Repositories',
        'Domain/Services',
        'Domain/ValueObjects',
        'Infrastructure/Database/Migrations',
        'Infrastructure/Database/Seeders',
        'Infrastructure/Persistence',
        'Infrastructure/Repositories',
        'Presentation/Http/Controllers',
        'Presentation/Http/Requests',
        'Presentation/Http/Resources',
        'Presentation/Routes',
        'Presentation/Views',
        'Providers',
        'Tests/Feature',
        'Tests/Unit',
    ];

    public function __construct(
        private readonly DirectoryManager $directories,
        private readonly JsonWriterContract $json,
        private readonly StubWriterContract $stubs,
        private readonly GitKeepGeneratorContract $gitKeep,
        private readonly string $modulesPath,
        private readonly string $templatesPath
    ) {
    }

    public function build(
        string $name,
        bool $overwrite = false
    ): string {
        $moduleName = $this->normalizeModuleName($name);
        $modulePath = $this->modulePath($moduleName);

        if (
            $this->directories->exists($modulePath)
            && ! $overwrite
        ) {
            throw new RuntimeException(
                "El módulo {$moduleName} ya existe."
            );
        }

        $this->directories->create($modulePath);

        $moduleDirectories = $this->createDirectories(
            $modulePath
        );

        $this->gitKeep->createMany(
            directories: $moduleDirectories,
            overwrite: $overwrite
        );

        $this->writeManifest(
            moduleName: $moduleName,
            modulePath: $modulePath,
            overwrite: $overwrite
        );

        $this->writeTemplates(
            moduleName: $moduleName,
            modulePath: $modulePath,
            overwrite: $overwrite
        );

        return $modulePath;
    }

    /**
     * @return array<int, string>
     */
    private function createDirectories(
        string $modulePath
    ): array {
        $paths = [];

        foreach (self::DIRECTORIES as $directory) {
            $paths[] = $modulePath
                .DIRECTORY_SEPARATOR
                .str_replace(
                    '/',
                    DIRECTORY_SEPARATOR,
                    $directory
                );
        }

        $this->directories->createMany($paths);

        return $paths;
    }

    private function writeManifest(
        string $moduleName,
        string $modulePath,
        bool $overwrite
    ): void {
        $this->json->write(
            path: $modulePath
                .DIRECTORY_SEPARATOR
                .'module.json',
            data: [
                'name' => $moduleName,
                'slug' => Str::kebab($moduleName),
                'version' => '0.1.0',
                'description' => "Módulo {$moduleName} del ERP",
                'provider' => $this->providerClass($moduleName),
                'enabled' => true,
                'dependencies' => [],
            ],
            overwrite: $overwrite
        );
    }

    private function writeTemplates(
        string $moduleName,
        string $modulePath,
        bool $overwrite
    ): void {
        $variables = [
            'Module' => $moduleName,
            'ModuleSlug' => Str::kebab($moduleName),
            'ModuleNamespace' => "App\\Modules\\{$moduleName}",
            'ProviderClass' => "{$moduleName}ServiceProvider",
        ];

        $this->writeStub(
            stub: 'service-provider.stub',
            destination: $modulePath
                .DIRECTORY_SEPARATOR
                .'Providers'
                .DIRECTORY_SEPARATOR
                ."{$moduleName}ServiceProvider.php",
            variables: $variables,
            overwrite: $overwrite
        );

        $this->writeStub(
            stub: 'web-routes.stub',
            destination: $modulePath
                .DIRECTORY_SEPARATOR
                .'Presentation'
                .DIRECTORY_SEPARATOR
                .'Routes'
                .DIRECTORY_SEPARATOR
                .'web.php',
            variables: $variables,
            overwrite: $overwrite
        );

        $this->writeStub(
            stub: 'api-routes.stub',
            destination: $modulePath
                .DIRECTORY_SEPARATOR
                .'Presentation'
                .DIRECTORY_SEPARATOR
                .'Routes'
                .DIRECTORY_SEPARATOR
                .'api.php',
            variables: $variables,
            overwrite: $overwrite
        );

        $this->writeStub(
            stub: 'readme.stub',
            destination: $modulePath
                .DIRECTORY_SEPARATOR
                .'README.md',
            variables: $variables,
            overwrite: $overwrite
        );
    }

    /**
     * @param array<string, scalar|null> $variables
     */
    private function writeStub(
        string $stub,
        string $destination,
        array $variables,
        bool $overwrite
    ): void {
        $this->stubs->write(
            stubPath: $this->templatesPath
                .DIRECTORY_SEPARATOR
                .$stub,
            destinationPath: $destination,
            variables: $variables,
            overwrite: $overwrite
        );
    }

    private function normalizeModuleName(
        string $name
    ): string {
        $name = trim($name);

        if ($name === '') {
            throw new InvalidArgumentException(
                'El nombre del módulo no puede estar vacío.'
            );
        }

        $moduleName = Str::studly($name);

        if (
            ! preg_match(
                '/^[A-Z][A-Za-z0-9]*$/',
                $moduleName
            )
        ) {
            throw new InvalidArgumentException(
                "Nombre de módulo inválido: {$name}"
            );
        }

        return $moduleName;
    }

    private function modulePath(
        string $moduleName
    ): string {
        return rtrim(
            $this->modulesPath,
            DIRECTORY_SEPARATOR.'/\\'
        )
            .DIRECTORY_SEPARATOR
            .$moduleName;
    }

    private function providerClass(
        string $moduleName
    ): string {
        return "App\\Modules\\{$moduleName}\\Providers\\".
            "{$moduleName}ServiceProvider";
    }
}