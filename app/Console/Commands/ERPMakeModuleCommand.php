<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use JsonException;
use Throwable;

final class ERPMakeModuleCommand extends Command
{
    protected $signature = 'erp:make-module
                            {name : Nombre del módulo}
                            {--force : Sobrescribir los archivos base existentes}';

    protected $description = 'Crea la estructura inicial de un módulo ERP';

    public function __construct(
        private readonly Filesystem $files
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $name = trim((string) $this->argument('name'));
        $moduleName = Str::studly($name);

        if ($moduleName === '') {
            $this->error('Debes indicar un nombre válido para el módulo.');

            return self::FAILURE;
        }

        $modulePath = app_path('Modules/'.$moduleName);

        if (
            $this->files->isDirectory($modulePath)
            && ! $this->option('force')
        ) {
            $this->error("El módulo {$moduleName} ya existe.");
            $this->line(
                "Usa php artisan erp:make-module {$moduleName} --force ".
                'para sobrescribir sus archivos base.'
            );

            return self::FAILURE;
        }

        try {
            $this->createDirectories($modulePath);
            $this->createManifest($modulePath, $moduleName);
            $this->createProvider($modulePath, $moduleName);
            $this->createRoutes($modulePath);
            $this->createReadme($modulePath, $moduleName);
        } catch (Throwable $exception) {
            $this->error('No fue posible crear el módulo.');
            $this->line($exception->getMessage());

            return self::FAILURE;
        }

        $provider = "App\\Modules\\{$moduleName}\\Providers\\".
            "{$moduleName}ServiceProvider";

        $this->newLine();
        $this->info("Módulo {$moduleName} creado correctamente.");

        $this->table(
            ['Propiedad', 'Valor'],
            [
                ['Nombre', $moduleName],
                ['Ruta', $modulePath],
                ['Provider', $provider],
                ['Manifiesto', $modulePath.DIRECTORY_SEPARATOR.'module.json'],
            ]
        );

        $this->comment(
            'Ejecuta php artisan erp:status para verificar el descubrimiento.'
        );

        return self::SUCCESS;
    }

    private function createDirectories(string $modulePath): void
    {
        $directories = [
            'Application/Commands',
            'Application/Queries',
            'Application/Services',
            'Domain/Entities',
            'Domain/Events',
            'Domain/Exceptions',
            'Domain/Repositories',
            'Domain/Services',
            'Infrastructure/Database/Migrations',
            'Infrastructure/Persistence',
            'Presentation/Http/Controllers',
            'Presentation/Http/Requests',
            'Presentation/Routes',
            'Presentation/Views',
            'Providers',
            'Tests/Feature',
            'Tests/Unit',
        ];

        foreach ($directories as $directory) {
            $path = $modulePath.DIRECTORY_SEPARATOR.$directory;

            if (! $this->files->isDirectory($path)) {
                $this->files->makeDirectory(
                    $path,
                    0755,
                    true
                );
            }

            $gitkeep = $path.DIRECTORY_SEPARATOR.'.gitkeep';

            if (! $this->files->exists($gitkeep)) {
                $this->files->put($gitkeep, '');
            }
        }
    }

    /**
     * @throws JsonException
     */
    private function createManifest(
        string $modulePath,
        string $moduleName
    ): void {
        $manifest = [
            'name' => $moduleName,
            'slug' => Str::kebab($moduleName),
            'version' => '0.1.0',
            'description' => "Módulo {$moduleName} del ERP",
            'provider' => "App\\Modules\\{$moduleName}\\Providers\\".
                "{$moduleName}ServiceProvider",
            'enabled' => true,
            'dependencies' => [],
        ];

        $content = json_encode(
            $manifest,
            JSON_PRETTY_PRINT
            | JSON_UNESCAPED_SLASHES
            | JSON_UNESCAPED_UNICODE
            | JSON_THROW_ON_ERROR
        );

        $this->writeFile(
            $modulePath.DIRECTORY_SEPARATOR.'module.json',
            $content.PHP_EOL
        );
    }

    private function createProvider(
        string $modulePath,
        string $moduleName
    ): void {
        $namespace = "App\\Modules\\{$moduleName}\\Providers";
        $viewNamespace = Str::kebab($moduleName);

        $content = <<<PHP
<?php

declare(strict_types=1);

namespace {$namespace};

use Illuminate\Support\ServiceProvider;

final class {$moduleName}ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \$this->loadRoutesFrom(
            __DIR__.'/../Presentation/Routes/web.php'
        );

        \$this->loadRoutesFrom(
            __DIR__.'/../Presentation/Routes/api.php'
        );

        \$this->loadViewsFrom(
            __DIR__.'/../Presentation/Views',
            '{$viewNamespace}'
        );

        \$this->loadMigrationsFrom(
            __DIR__.'/../Infrastructure/Database/Migrations'
        );
    }
}

PHP;

        $path = $modulePath
            .DIRECTORY_SEPARATOR
            .'Providers'
            .DIRECTORY_SEPARATOR
            .$moduleName
            .'ServiceProvider.php';

        $this->writeFile($path, $content);
    }

    private function createRoutes(string $modulePath): void
    {
        $routesPath = $modulePath
            .DIRECTORY_SEPARATOR
            .'Presentation'
            .DIRECTORY_SEPARATOR
            .'Routes';

        $webRoutes = <<<'PHP'
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas web del módulo
|--------------------------------------------------------------------------
*/

PHP;

        $apiRoutes = <<<'PHP'
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas API del módulo
|--------------------------------------------------------------------------
*/

PHP;

        $this->writeFile(
            $routesPath.DIRECTORY_SEPARATOR.'web.php',
            $webRoutes
        );

        $this->writeFile(
            $routesPath.DIRECTORY_SEPARATOR.'api.php',
            $apiRoutes
        );
    }

    private function createReadme(
        string $modulePath,
        string $moduleName
    ): void {
        $content = "# Módulo {$moduleName}".PHP_EOL.PHP_EOL;
        $content .= "## Descripción".PHP_EOL.PHP_EOL;
        $content .= "Módulo generado por el núcleo del ERP.".PHP_EOL.PHP_EOL;
        $content .= "## Versión".PHP_EOL.PHP_EOL;
        $content .= "0.1.0".PHP_EOL.PHP_EOL;
        $content .= "## Estructura".PHP_EOL.PHP_EOL;
        $content .= "- Application".PHP_EOL;
        $content .= "- Domain".PHP_EOL;
        $content .= "- Infrastructure".PHP_EOL;
        $content .= "- Presentation".PHP_EOL;
        $content .= "- Providers".PHP_EOL;
        $content .= "- Tests".PHP_EOL.PHP_EOL;
        $content .= "## Verificación".PHP_EOL.PHP_EOL;
        $content .= "Ejecutar: php artisan erp:status".PHP_EOL;

        $this->writeFile(
            $modulePath.DIRECTORY_SEPARATOR.'README.md',
            $content
        );
    }

    private function writeFile(string $path, string $content): void
    {
        if (
            $this->files->exists($path)
            && ! $this->option('force')
        ) {
            return;
        }

        $this->files->put($path, $content);
    }
}