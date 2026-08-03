<?php

declare(strict_types=1);

namespace App\Core\Contracts;

interface GitKeepGeneratorContract
{
    public function create(
        string $directory,
        bool $overwrite = false
    ): void;

    /**
     * @param array<int, string> $directories
     */
    public function createMany(
        array $directories,
        bool $overwrite = false
    ): void;
}
