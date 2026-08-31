<?php

declare(strict_types=1);

namespace Tests\Unit\Core\Builders;

use App\Core\Builders\ModuleBuilder;
use App\Core\FileSystem\DirectoryManager;
use App\Core\FileSystem\FileWriter;
use App\Core\FileSystem\GitKeepGenerator;
use App\Core\FileSystem\JsonWriter;
use App\Core\FileSystem\StubWriter;
use App\Core\Template\TemplateEngine;
use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class ModuleBuilderTest extends TestCase
{
    private Filesystem $filesystem;

    private string $temporaryPath;

    private string $modulesPath;

    private string $templatesPath;

    private ModuleBuilder $builder;

    protected function setUp(): void
{
    parent::setUp();

    $this->filesystem = new Filesystem();

    $this->temporaryPath = sys_get_temp_dir()
        .DIRECTORY_SEPARATOR
        .'erp-module-builder-tests-'
        .bin2hex(random_bytes(8));

    $this->modulesPath = $this->temporaryPath
        .DIRECTORY_SEPARATOR
        .'Modules';

    $projectRoot = dirname(__DIR__, 4);

    $this->templatesPath = $projectRoot
        .DIRECTORY_SEPARATOR
        .'app'
        .DIRECTORY_SEPARATOR
        .'Core'
        .DIRECTORY_SEPARATOR
        .'Templates'
        .DIRECTORY_SEPARATOR
        .'module';

    $directoryManager = new DirectoryManager(
        $this->filesystem
    );

    $fileWriter = new FileWriter(
        $this->filesystem,
        $directoryManager
    );

    $this->builder = new ModuleBuilder(
        directories: $directoryManager,
        json: new JsonWriter(
            $fileWriter
        ),
        stubs: new StubWriter(
            new TemplateEngine(
                $this->filesystem
            ),
            $fileWriter
        ),
        gitKeep: new GitKeepGenerator(
            $directoryManager,
            $fileWriter
        ),
        modulesPath: $this->modulesPath,
        templatesPath: $this->templatesPath
    );
}

    protected function tearDown(): void
    {
        if ($this->filesystem->isDirectory($this->temporaryPath)) {
            $this->filesystem->deleteDirectory(
                $this->temporaryPath
            );
        }

        parent::tearDown();
    }

    public function test_it_builds_a_complete_module_structure(): void
    {
        $modulePath = $this->builder->build(
            'inventario'
        );

        $this->assertSame(
            $this->modulesPath
                .DIRECTORY_SEPARATOR
                .'Inventario',
            $modulePath
        );

        $this->assertDirectoryExists($modulePath);

        $this->assertFileExists(
            $modulePath
                .DIRECTORY_SEPARATOR
                .'module.json'
        );

        $this->assertFileExists(
            $modulePath
                .DIRECTORY_SEPARATOR
                .'Providers'
                .DIRECTORY_SEPARATOR
                .'InventarioServiceProvider.php'
        );

        $this->assertFileExists(
            $modulePath
                .DIRECTORY_SEPARATOR
                .'Presentation'
                .DIRECTORY_SEPARATOR
                .'Routes'
                .DIRECTORY_SEPARATOR
                .'web.php'
        );

        $this->assertFileExists(
            $modulePath
                .DIRECTORY_SEPARATOR
                .'Presentation'
                .DIRECTORY_SEPARATOR
                .'Routes'
                .DIRECTORY_SEPARATOR
                .'api.php'
        );

        $this->assertFileExists(
            $modulePath
                .DIRECTORY_SEPARATOR
                .'README.md'
        );
    }

    public function test_it_writes_a_valid_manifest(): void
    {
        $modulePath = $this->builder->build(
            'gestion documental'
        );

        $manifest = json_decode(
            $this->filesystem->get(
                $modulePath
                    .DIRECTORY_SEPARATOR
                    .'module.json'
            ),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $this->assertSame(
            'GestionDocumental',
            $manifest['name']
        );

        $this->assertSame(
            'gestion-documental',
            $manifest['slug']
        );

        $this->assertSame(
            '0.1.0',
            $manifest['version']
        );

        $this->assertSame(
            'App\\Modules\\GestionDocumental\\Providers\\GestionDocumentalServiceProvider',
            $manifest['provider']
        );

        $this->assertTrue(
            $manifest['enabled']
        );

        $this->assertSame(
            [],
            $manifest['dependencies']
        );
    }

    public function test_it_rejects_an_empty_module_name(): void
    {
        $this->expectException(
            InvalidArgumentException::class
        );

        $this->builder->build('   ');
    }

    public function test_it_prevents_accidental_overwriting(): void
    {
        $this->builder->build(
            'Inventario'
        );

        $this->expectException(
            RuntimeException::class
        );

        $this->builder->build(
            'Inventario'
        );
    }

    public function test_it_allows_explicit_overwriting(): void
    {
        $firstPath = $this->builder->build(
            'Inventario'
        );

        $secondPath = $this->builder->build(
            'Inventario',
            overwrite: true
        );

        $this->assertSame(
            $firstPath,
            $secondPath
        );

        $this->assertFileExists(
            $secondPath
                .DIRECTORY_SEPARATOR
                .'module.json'
        );
    }
}
