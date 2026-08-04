<?php

declare(strict_types=1);

namespace App\Core\FileSystem;

use App\Core\Contracts\FileWriterContract;
use App\Core\Contracts\JsonWriterContract;
use JsonException;
use RuntimeException;

final class JsonWriter implements JsonWriterContract
{
    public function __construct(
        private readonly FileWriterContract $files
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public function write(
        string $path,
        array $data,
        bool $overwrite = false
    ): void {
        try {
            $json = json_encode(
                $data,
                JSON_PRETTY_PRINT
                | JSON_UNESCAPED_SLASHES
                | JSON_UNESCAPED_UNICODE
                | JSON_THROW_ON_ERROR
            );
        } catch (JsonException $exception) {
            throw new RuntimeException(
                "No fue posible convertir los datos a JSON para: {$path}",
                previous: $exception
            );
        }

        $this->files->write(
            path: $path,
            content: $json.PHP_EOL,
            overwrite: $overwrite
        );
    }
}
