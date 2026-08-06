<?php

declare(strict_types=1);

namespace App\Core\Contracts;

interface ValueObject
{
    /**
     * Devuelve el valor interno del objeto.
     */
    public function value(): mixed;

    /**
     * Compara dos Value Objects del mismo tipo.
     */
    public function equals(self $other): bool;

    /**
     * Representación textual del Value Object.
     */
    public function __toString(): string;
}