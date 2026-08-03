<?php

declare(strict_types=1);

namespace App\Core\FileSystem;

use App\Core\Contracts\FileWriterContract;
use App\Core\Contracts\StubWriterContract;
use App\Core\Template\TemplateEngine;

final class StubWriter implements StubWriterContract
{
    public function __construct(
        private readonly TemplateEngine $templates,
        private readonly FileWriterContract $files
    ) {
    }

    /**
     * @param array<string, scalar|null> $variables
     */
    public function write(
        string $stubPath,
        string $destinationPath,
        array $variables = [],
        bool $overwrite = false
    ): void {
        $content = $this->templates->render(
            $stubPath,
            $variables
        );

        $this->files->write(
            path: $destinationPath,
            content: $content,
            overwrite: $overwrite
        );
    }
}