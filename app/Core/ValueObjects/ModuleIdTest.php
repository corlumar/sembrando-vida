<?php

declare(strict_types=1);

namespace Tests\Unit\Core\ValueObjects;

use App\Core\ValueObjects\ModuleId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ModuleIdTest extends TestCase
{
    public function test_crea_un_module_id_valido(): void
    {
        $id = new ModuleId('crm');

        $this->assertSame('crm', $id->value());
    }

    public function test_puede_convertirse_a_string(): void
    {
        $id = new ModuleId('inventory');

        $this->assertSame(
            'inventory',
            (string) $id
        );
    }

    public function test_dos_ids_iguales_son_equivalentes(): void
    {
        $this->assertTrue(
            (new ModuleId('crm'))
                ->equals(new ModuleId('crm'))
        );
    }

    public function test_dos_ids_diferentes_no_son_equivalentes(): void
    {
        $this->assertFalse(
            (new ModuleId('crm'))
                ->equals(new ModuleId('inventory'))
        );
    }

    public function test_no_permite_cadena_vacia(): void
    {
        $this->expectException(
            InvalidArgumentException::class
        );

        new ModuleId('');
    }

    public function test_no_permite_mayusculas(): void
    {
        $this->expectException(
            InvalidArgumentException::class
        );

        new ModuleId('CRM');
    }

    public function test_no_permite_iniciar_con_numero(): void
    {
        $this->expectException(
            InvalidArgumentException::class
        );

        new ModuleId('1crm');
    }

    public function test_no_permite_caracteres_especiales(): void
    {
        $this->expectException(
            InvalidArgumentException::class
        );

        new ModuleId('crm!');
    }
}