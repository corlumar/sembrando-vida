<?php

declare(strict_types=1);

namespace App\Core\Contracts;

interface JsonWriterContract
{
    /**
     * @param array<string, mixed> $data
     */
    public function write(
        string $path,
        array $data,
        bool $overwrite = false
    ): void;
}