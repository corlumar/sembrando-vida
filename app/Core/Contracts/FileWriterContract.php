<?php

declare(strict_types=1);

namespace App\Core\Contracts;

interface FileWriterContract
{
    public function write(
        string $path,
        string $content,
        bool $overwrite = false
    ): void;

    public function exists(string $path): bool;

    public function delete(string $path): void;
}