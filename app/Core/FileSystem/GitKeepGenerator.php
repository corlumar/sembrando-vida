<?php

declare(strict_types=1);

namespace App\Core\FileSystem;

use App\Core\Contracts\FileWriterContract;
use App\Core\Contracts\GitKeepGeneratorContract;
use InvalidArgumentException;

final class GitKeepGenerator implements GitKeepGeneratorContract
{
    public function __construct(
        private readonly DirectoryManager $directories,
        private readonly FileWriterContract $files
    ) {
    }

    public function create(
        string $directory,
        bool $overwrite = false
    ): void {
        $directory = $this->normalizeDirectory($directory);

        $this->directories->create($directory);

        $this->files->write(
            path: $directory.DIRECTORY_SEPARATOR.'.gitkeep',
            content: '',
            overwrite: $overwrite
        );
    }

    /**
     * @param array<int, string> $directories
     */
    public function createMany(
        array $directories,
        bool $overwrite = false
    ): void {
        foreach ($directories as $directory) {
            $this->create(
                directory: $directory,
                overwrite: $overwrite
            );
        }
    }

    private function normalizeDirectory(string $directory): string
    {
        $directory = trim($directory);

        if ($directory === '') {
            throw new InvalidArgumentException(
                'La ruta del directorio no puede estar vacía.'
            );
        }

        return rtrim(
            $directory,
            DIRECTORY_SEPARATOR.'/\\'
        );
    }
}