<?php

declare(strict_types=1);

namespace App\Core\Contracts;

interface ERPKernelContract
{
    public function boot(): void;

    public function discoverModules(): void;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function modules(): array;

    public function hasModule(string $name): bool;
}
