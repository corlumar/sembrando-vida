<?php

declare(strict_types=1);

namespace Tests\Unit\Core\FileSystem;

use App\Core\FileSystem\DirectoryManager;
use App\Core\FileSystem\FileWriter;
use App\Core\FileSystem\JsonWriter;
use Illuminate\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class JsonWriterTest extends TestCase
{
    private Filesystem $files;

    private JsonWriter $writer;

    private string $testDirectory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();

        $fileWriter = new FileWriter(
            $this->files,
            new DirectoryManager($this->files)
        );

        $this->writer = new JsonWriter($fileWriter);

        $this->testDirectory = sys_get_temp_dir()
            .DIRECTORY_SEPARATOR
            .'erp-json-writer-tests'
            .DIRECTORY_SEPARATOR
            .uniqid('test-', true);
    }

    protected function tearDown(): void
    {
        if ($this->files->isDirectory($this->testDirectory)) {
            $this->files->deleteDirectory($this->testDirectory);
        }

        parent::tearDown();
    }

    public function test_it_writes_valid_json(): void
    {
        $path = $this->path('module.json');

        $this->writer->write(
            $path,
            [
                'name' => 'Organizacion',
                'version' => '0.1.0',
                'enabled' => true,
            ]
        );

        self::assertTrue($this->files->isFile($path));

        $decoded = json_decode(
            $this->files->get($path),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        self::assertSame('Organizacion', $decoded['name']);
        self::assertSame('0.1.0', $decoded['version']);
        self::assertTrue($decoded['enabled']);
    }

    public function test_it_formats_json_for_readability(): void
    {
        $path = $this->path('module.json');

        $this->writer->write(
            $path,
            [
                'name' => 'Organizacion',
                'dependencies' => [],
            ]
        );

        $content = $this->files->get($path);

        self::assertStringContainsString(
            PHP_EOL,
            $content
        );

        self::assertStringContainsString(
            '    "name": "Organizacion"',
            $content
        );
    }

    public function test_it_preserves_unicode_characters(): void
    {
        $path = $this->path('module.json');

        $this->writer->write(
            $path,
            [
                'description' => 'Módulo de Organización',
            ]
        );

        self::assertStringContainsString(
            'Módulo de Organización',
            $this->files->get($path)
        );
    }

    public function test_it_prevents_accidental_overwriting(): void
    {
        $path = $this->path('module.json');

        $this->writer->write($path, ['version' => '0.1.0']);

        $this->expectException(RuntimeException::class);

        $this->writer->write($path, ['version' => '0.2.0']);
    }

    public function test_it_allows_explicit_overwriting(): void
    {
        $path = $this->path('module.json');

        $this->writer->write($path, ['version' => '0.1.0']);

        $this->writer->write(
            $path,
            ['version' => '0.2.0'],
            true
        );

        $decoded = json_decode(
            $this->files->get($path),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        self::assertSame('0.2.0', $decoded['version']);
    }

    private function path(string $filename): string
    {
        return $this->testDirectory
            .DIRECTORY_SEPARATOR
            .$filename;
    }
}