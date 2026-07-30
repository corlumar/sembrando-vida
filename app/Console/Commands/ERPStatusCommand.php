<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Core\Contracts\ERPKernelContract;
use Illuminate\Console\Command;

final class ERPStatusCommand extends Command
{
    /**
     * Nombre y firma del comando.
     *
     * @var string
     */
    protected $signature = 'erp:status';

    /**
     * Descripción del comando.
     *
     * @var string
     */
    protected $description = 'Muestra el estado actual del ERP Core';

    public function handle(ERPKernelContract $kernel): int
    {
        $modules = $kernel->modules();

        $this->newLine();
        $this->components->info('ERP Core iniciado correctamente');

        $this->table(
            ['Propiedad', 'Valor'],
            [
                ['Nombre', (string) config('erp.name')],
                ['Versión', (string) config('erp.version')],
                [
                    'Descubrimiento automático',
                    config('erp.auto_discovery')
                        ? 'Habilitado'
                        : 'Deshabilitado',
                ],
                ['Módulos descubiertos', (string) count($modules)],
                ['Ruta de módulos', (string) config('erp.modules_path')],
            ]
        );

        if ($modules === []) {
            $this->components->warn(
                'Todavía no existen módulos instalados.'
            );

            return self::SUCCESS;
        }

        $this->newLine();
        $this->components->info('Módulos registrados');

        $rows = [];

        foreach ($modules as $module) {
            $rows[] = [
                (string) $module['name'],
                (string) $module['version'],
                (string) $module['provider'],
            ];
        }

        $this->table(
            ['Módulo', 'Versión', 'Proveedor'],
            $rows
        );

        return self::SUCCESS;
    }
}