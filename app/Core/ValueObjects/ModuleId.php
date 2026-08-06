<?php

declare(strict_types=1);

namespace App\Core\ValueObjects;

use InvalidArgumentException;

final readonly class ModuleId
{
    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 50;

    public function __construct(
        private string $value,
    ) {
        $this->assertValid($value);
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function assertValid(string $value): void
    {
        if ($value === '') {
            throw new InvalidArgumentException(
                'ModuleId no puede estar vacío.'
            );
        }

        if (strlen($value) < self::MIN_LENGTH) {
            throw new InvalidArgumentException(
                sprintf(
                    'ModuleId debe tener al menos %d caracteres.',
                    self::MIN_LENGTH
                )
            );
        }

        if (strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException(
                sprintf(
                    'ModuleId no puede superar %d caracteres.',
                    self::MAX_LENGTH
                )
            );
        }

        if (! preg_match('/^[a-z][a-z0-9_-]*$/', $value)) {
            throw new InvalidArgumentException(
                'ModuleId solo permite letras minúsculas, números, guion y guion bajo, y debe iniciar con una letra.'
            );
        }
    }
}