<?php

declare(strict_types=1);

namespace Tests\Unit\Core\FileSystem;

use App\Core\FileSystem\DirectoryManager;
use App\Core\FileSystem\FileWriter;
use App\Core\FileSystem\StubWriter;
use App\Core\Template\TemplateEngine;
use Illuminate\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class StubWriterTest extends TestCase
{
    private Filesystem $files;

    private StubWriter $writer;

    private string $testDirectory;

    private string $stubPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();

        $fileWriter = new FileWriter(
            $this->files,
            new DirectoryManager($this->files)
        );

        $this->writer = new StubWriter(
            new TemplateEngine($this->files),
            $fileWriter
        );

        $this->testDirectory = sys_get_temp_dir()
            .DIRECTORY_SEPARATOR
            .'erp-stub-writer-tests'
            .DIRECTORY_SEPARATOR
            .uniqid('test-', true);

        $this->stubPath = dirname(__DIR__, 3)
            .DIRECTORY_SEPARATOR
            .'Fixtures'
            .DIRECTORY_SEPARATOR
            .'Templates'
            .DIRECTORY_SEPARATOR
            .'service.stub';
    }

    protected function tearDown(): void
    {
        if ($this->files->isDirectory($this->testDirectory)) {
            $this->files->deleteDirectory($this->testDirectory);
        }

        parent::tearDown();
    }

    public function test_it_renders_and_writes_a_stub(): void
    {
        $destination = $this->path('ExampleService.php');

        $this->writer->write(
            stubPath: $this->stubPath,
            destinationPath: $destination,
            variables: [
                'Namespace' => 'App\\Modules\\Example\\Application',
                'ClassName' => 'ExampleService',
            ]
        );

        self::assertTrue(
            $this->files->isFile($destination)
        );

        $content = $this->files->get($destination);

        self::assertStringContainsString(
            'namespace App\\Modules\\Example\\Application;',
            $content
        );

        self::assertStringContainsString(
            'final class ExampleService',
            $content
        );
    }

    public function test_it_prevents_accidental_overwriting(): void
    {
        $destination = $this->path('ExampleService.php');

        $variables = [
            'Namespace' => 'App\\Modules\\Example\\Application',
            'ClassName' => 'ExampleService',
        ];

        $this->writer->write(
            $this->stubPath,
            $destination,
            $variables
        );

        $this->expectException(RuntimeException::class);

        $this->writer->write(
            $this->stubPath,
            $destination,
            $variables
        );
    }

    public function test_it_allows_explicit_overwriting(): void
    {
        $destination = $this->path('ExampleService.php');

        $this->writer->write(
            $this->stubPath,
            $destination,
            [
                'Namespace' => 'App\\Modules\\Example',
                'ClassName' => 'FirstService',
            ]
        );

        $this->writer->write(
            $this->stubPath,
            $destination,
            [
                'Namespace' => 'App\\Modules\\Example',
                'ClassName' => 'SecondService',
            ],
            true
        );

        self::assertStringContainsString(
            'final class SecondService',
            $this->files->get($destination)
        );
    }

    private function path(string $filename): string
    {
        return $this->testDirectory
            .DIRECTORY_SEPARATOR
            .$filename;
    }
}