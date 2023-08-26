<?php

declare(strict_types=1);

namespace App\Enums\Traits;

trait EnumsHelper
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toArray(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function fromName(string $name): ?self
    {
        if (in_array($name, self::names())) {
            return self::from($name);
        }

        return null;
    }

    public static function fromValue(string $value): ?self
    {
        if (in_array($value, self::values())) {
            return self::from($value);
        }

        return null;
    }
}
