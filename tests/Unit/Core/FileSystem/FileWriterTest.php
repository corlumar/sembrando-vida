<?php

declare(strict_types=1);

namespace Tests\Unit\Core\FileSystem;

use App\Core\FileSystem\DirectoryManager;
use App\Core\FileSystem\FileWriter;
use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class FileWriterTest extends TestCase
{
    private Filesystem $files;

    private FileWriter $writer;

    private string $testDirectory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();

        $this->writer = new FileWriter(
            $this->files,
            new DirectoryManager($this->files)
        );

        $this->testDirectory = sys_get_temp_dir()
            .DIRECTORY_SEPARATOR
            .'erp-file-writer-tests'
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

    public function test_it_writes_a_file(): void
    {
        $path = $this->path('example.txt');

        $this->writer->write($path, 'ERP Core');

        self::assertTrue($this->writer->exists($path));
        self::assertSame('ERP Core', $this->files->get($path));
    }

    public function test_it_creates_parent_directories(): void
    {
        $path = $this->path(
            'nested'.DIRECTORY_SEPARATOR.'example.txt'
        );

        $this->writer->write($path, 'Contenido');

        self::assertTrue($this->files->isFile($path));
    }

    public function test_it_prevents_accidental_overwriting(): void
    {
        $path = $this->path('example.txt');

        $this->writer->write($path, 'Original');

        $this->expectException(RuntimeException::class);

        $this->writer->write($path, 'Nuevo');
    }

    public function test_it_allows_explicit_overwriting(): void
    {
        $path = $this->path('example.txt');

        $this->writer->write($path, 'Original');
        $this->writer->write($path, 'Nuevo', true);

        self::assertSame('Nuevo', $this->files->get($path));
    }

    public function test_it_deletes_a_file(): void
    {
        $path = $this->path('example.txt');

        $this->writer->write($path, 'Contenido');
        $this->writer->delete($path);

        self::assertFalse($this->writer->exists($path));
    }

    public function test_delete_is_idempotent(): void
    {
        $path = $this->path('missing.txt');

        $this->writer->delete($path);

        self::assertFalse($this->writer->exists($path));
    }

    public function test_it_rejects_an_empty_path(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->writer->write('   ', 'Contenido');
    }

    private function path(string $relativePath): string
    {
        return $this->testDirectory
            .DIRECTORY_SEPARATOR
            .$relativePath;
    }
}