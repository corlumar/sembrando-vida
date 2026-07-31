<?php

declare(strict_types=1);

namespace App\Core\FileSystem;

use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use RuntimeException;

final class DirectoryManager
{
    public function __construct(
        private readonly Filesystem $files
    ) {
    }

    public function create(
        string $path,
        int $permissions = 0755
    ): void {
        $path = $this->normalizePath($path);

        if ($this->files->isDirectory($path)) {
            return;
        }

        $created = $this->files->makeDirectory(
            $path,
            $permissions,
            true,
            true
        );

        if (! $created && ! $this->files->isDirectory($path)) {
            throw new RuntimeException(
                "No fue posible crear el directorio: {$path}"
            );
        }
    }

    /**
     * @param array<int, string> $paths
     */
    public function createMany(array $paths): void
    {
        foreach ($paths as $path) {
            $this->create($path);
        }
    }

    public function exists(string $path): bool
    {
        return $this->files->isDirectory(
            $this->normalizePath($path)
        );
    }

    public function delete(string $path): void
    {
        $path = $this->normalizePath($path);

        if (! $this->files->isDirectory($path)) {
            return;
        }

        $deleted = $this->files->deleteDirectory($path);

        if (! $deleted && $this->files->isDirectory($path)) {
            throw new RuntimeException(
                "No fue posible eliminar el directorio: {$path}"
            );
        }
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '') {
            throw new InvalidArgumentException(
                'La ruta del directorio no puede estar vacía.'
            );
        }

        return rtrim(
            $path,
            DIRECTORY_SEPARATOR.'/\\'
        );
    }
}