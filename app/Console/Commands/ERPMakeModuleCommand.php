<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Core\Contracts\ModuleBuilderContract;
use Illuminate\Console\Command;
use Throwable;

final class ERPMakeModuleCommand extends Command
{
    protected $signature = 'erp:make-module
                            {name : Nombre del módulo}
                            {--force : Sobrescribir los archivos base existentes}';

    protected $description = 'Crea la estructura inicial de un módulo ERP';

    public function __construct(
        private readonly ModuleBuilderContract $builder
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $name = trim((string) $this->argument('name'));
        $overwrite = (bool) $this->option('force');

        try {
            $modulePath = $this->builder->build(
                name: $name,
                overwrite: $overwrite
            );
        } catch (Throwable $exception) {
            $this->error('No fue posible crear el módulo.');
            $this->line($exception->getMessage());

            return self::FAILURE;
        }

        $moduleName = basename($modulePath);

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
                [
                    'Manifiesto',
                    $modulePath.DIRECTORY_SEPARATOR.'module.json',
                ],
            ]
        );

        $this->comment(
            'Ejecuta php artisan erp:status para verificar el descubrimiento.'
        );

        return self::SUCCESS;
    }
}
