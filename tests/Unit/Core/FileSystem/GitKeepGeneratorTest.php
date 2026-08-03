<?php

declare(strict_types=1);

namespace Tests\Unit\Core\FileSystem;

use App\Core\FileSystem\DirectoryManager;
use App\Core\FileSystem\FileWriter;
use App\Core\FileSystem\GitKeepGenerator;
use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class GitKeepGeneratorTest extends TestCase
{
    private Filesystem $files;

    private GitKeepGenerator $generator;

    private string $testDirectory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();

        $directoryManager = new DirectoryManager(
            $this->files
        );

        $fileWriter = new FileWriter(
            $this->files,
            $directoryManager
        );

        $this->generator = new GitKeepGenerator(
            $directoryManager,
            $fileWriter
        );

        $this->testDirectory = sys_get_temp_dir()
            .DIRECTORY_SEPARATOR
            .'erp-gitkeep-tests'
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

    public function test_it_creates_a_gitkeep_file(): void
    {
        $directory = $this->path('Domain');

        $this->generator->create($directory);

        self::assertTrue(
            $this->files->isFile(
                $directory.DIRECTORY_SEPARATOR.'.gitkeep'
            )
        );
    }

    public function test_it_creates_the_parent_directory(): void
    {
        $directory = $this->path(
            'Application'
            .DIRECTORY_SEPARATOR
            .'Commands'
        );

        $this->generator->create($directory);

        self::assertTrue(
            $this->files->isDirectory($directory)
        );

        self::assertTrue(
            $this->files->isFile(
                $directory.DIRECTORY_SEPARATOR.'.gitkeep'
            )
        );
    }

    public function test_it_creates_many_gitkeep_files(): void
    {
        $domain = $this->path('Domain');
        $application = $this->path('Application');
        $infrastructure = $this->path('Infrastructure');

        $this->generator->createMany([
            $domain,
            $application,
            $infrastructure,
        ]);

        self::assertTrue(
            $this->files->isFile(
                $domain.DIRECTORY_SEPARATOR.'.gitkeep'
            )
        );

        self::assertTrue(
            $this->files->isFile(
                $application.DIRECTORY_SEPARATOR.'.gitkeep'
            )
        );

        self::assertTrue(
            $this->files->isFile(
                $infrastructure.DIRECTORY_SEPARATOR.'.gitkeep'
            )
        );
    }

    public function test_it_prevents_accidental_overwriting(): void
    {
        $directory = $this->path('Domain');

        $this->generator->create($directory);

        $this->expectException(RuntimeException::class);

        $this->generator->create($directory);
    }

    public function test_it_allows_explicit_overwriting(): void
    {
        $directory = $this->path('Domain');

        $this->generator->create($directory);

        $this->generator->create(
            directory: $directory,
            overwrite: true
        );

        self::assertTrue(
            $this->files->isFile(
                $directory.DIRECTORY_SEPARATOR.'.gitkeep'
            )
        );
    }

    public function test_it_rejects_an_empty_directory(): void
    {
        $this->expectException(
            InvalidArgumentException::class
        );

        $this->generator->create('   ');
    }

    private function path(string $relativePath): string
    {
        return $this->testDirectory
            .DIRECTORY_SEPARATOR
            .$relativePath;
    }
}