<?php

declare(strict_types=1);

namespace Tests\Unit\Core\FileSystem;

use App\Core\FileSystem\DirectoryManager;
use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class DirectoryManagerTest extends TestCase
{
    private Filesystem $files;

    private DirectoryManager $manager;

    private string $testPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();
        $this->manager = new DirectoryManager($this->files);

        $this->testPath = sys_get_temp_dir()
            .DIRECTORY_SEPARATOR
            .'erp-core-tests'
            .DIRECTORY_SEPARATOR
            .uniqid('directory-', true);
    }

    protected function tearDown(): void
    {
        if ($this->files->isDirectory($this->testPath)) {
            $this->files->deleteDirectory($this->testPath);
        }

        parent::tearDown();
    }

    public function test_it_creates_a_directory(): void
    {
        $this->manager->create($this->testPath);

        self::assertTrue(
            $this->files->isDirectory($this->testPath)
        );
    }

    public function test_create_is_idempotent(): void
    {
        $this->manager->create($this->testPath);
        $this->manager->create($this->testPath);

        self::assertTrue(
            $this->manager->exists($this->testPath)
        );
    }

    public function test_it_creates_many_directories(): void
    {
        $first = $this->testPath.DIRECTORY_SEPARATOR.'first';
        $second = $this->testPath.DIRECTORY_SEPARATOR.'second';

        $this->manager->createMany([
            $first,
            $second,
        ]);

        self::assertTrue($this->files->isDirectory($first));
        self::assertTrue($this->files->isDirectory($second));
    }

    public function test_it_deletes_a_directory(): void
    {
        $this->manager->create($this->testPath);

        $this->manager->delete($this->testPath);

        self::assertFalse(
            $this->files->isDirectory($this->testPath)
        );
    }

    public function test_it_rejects_an_empty_path(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->manager->create('   ');
    }
}