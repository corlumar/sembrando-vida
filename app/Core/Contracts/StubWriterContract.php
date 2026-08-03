<?php

declare(strict_types=1);

namespace App\Core\Contracts;

interface StubWriterContract
{
    /**
     * @param array<string, scalar|null> $variables
     */
    public function write(
        string $stubPath,
        string $destinationPath,
        array $variables = [],
        bool $overwrite = false
    ): void;
}