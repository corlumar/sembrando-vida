<?php

declare(strict_types=1);

namespace App\Core\Template;

use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use RuntimeException;

final class TemplateEngine
{
    public function __construct(
        private readonly Filesystem $files
    ) {
    }

    /**
     * Renderiza una plantilla sustituyendo sus variables.
     *
     * Ejemplo:
     * {{Module}} será reemplazado por Organizacion.
     *
     * @param array<string, scalar|null> $variables
     */
    public function render(string $templatePath, array $variables = []): string
    {
        if (! $this->files->exists($templatePath)) {
            throw new InvalidArgumentException(
                "La plantilla no existe: {$templatePath}"
            );
        }

        if (! $this->files->isFile($templatePath)) {
            throw new InvalidArgumentException(
                "La ruta indicada no es un archivo: {$templatePath}"
            );
        }

        $content = $this->files->get($templatePath);

        foreach ($variables as $name => $value) {
            $this->validateVariableName($name);

            $replacement = $value === null
                ? ''
                : (string) $value;

            $content = str_replace(
                [
                    '{{'.$name.'}}',
                    '{{ '.$name.' }}',
                ],
                $replacement,
                $content
            );
        }

        return $content;
    }

    /**
     * Renderiza una plantilla y guarda el resultado en un archivo.
     *
     * @param array<string, scalar|null> $variables
     */
    public function renderToFile(
        string $templatePath,
        string $destinationPath,
        array $variables = [],
        bool $overwrite = false
    ): void {
        if (
            $this->files->exists($destinationPath)
            && ! $overwrite
        ) {
            throw new RuntimeException(
                "El archivo de destino ya existe: {$destinationPath}"
            );
        }

        $directory = dirname($destinationPath);

        if (! $this->files->isDirectory($directory)) {
            $this->files->makeDirectory(
                $directory,
                0755,
                true
            );
        }

        $content = $this->render(
            $templatePath,
            $variables
        );

        $bytesWritten = $this->files->put(
            $destinationPath,
            $content
        );

        if ($bytesWritten === false) {
            throw new RuntimeException(
                "No fue posible escribir el archivo: {$destinationPath}"
            );
        }
    }

    private function validateVariableName(string $name): void
    {
        if (! preg_match('/^[A-Za-z][A-Za-z0-9_]*$/', $name)) {
            throw new InvalidArgumentException(
                "Nombre de variable inválido: {$name}"
            );
        }
    }
}