<?php

declare(strict_types=1);

namespace App\Core\Contracts;

interface ModuleBuilderContract
{
    /**
     * Construye la estructura inicial de un módulo.
     *
     * @return string Ruta absoluta del módulo creado.
     */
    public function build(
        string $name,
        bool $overwrite = false
    ): string;
}