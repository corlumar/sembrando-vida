<?php

declare(strict_types=1);

namespace App\Core\FileSystem;

use App\Core\Contracts\FileWriterContract;
use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use RuntimeException;

final class FileWriter implements FileWriterContract
{
    public function __construct(
        private readonly Filesystem $files,
        private readonly DirectoryManager $directories
    ) {
    }

    public function write(
        string $path,
        string $content,
        bool $overwrite = false
    ): void {
        $path = $this->normalizePath($path);

        if ($this->files->exists($path) && ! $overwrite) {
            throw new RuntimeException(
                "El archivo ya existe: {$path}"
            );
        }

        $this->directories->create(dirname($path));

        $writtenBytes = $this->files->put($path, $content);

        if ($writtenBytes === false) {
            throw new RuntimeException(
                "No fue posible escribir el archivo: {$path}"
            );
        }
    }

    public function exists(string $path): bool
    {
        return $this->files->isFile(
            $this->normalizePath($path)
        );
    }

    public function delete(string $path): void
    {
        $path = $this->normalizePath($path);

        if (! $this->files->exists($path)) {
            return;
        }

        if (! $this->files->delete($path)) {
            throw new RuntimeException(
                "No fue posible eliminar el archivo: {$path}"
            );
        }
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '') {
            throw new InvalidArgumentException(
                'La ruta del archivo no puede estar vacía.'
            );
        }

        return $path;
    }
}