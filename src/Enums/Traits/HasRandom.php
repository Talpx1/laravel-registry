<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Traits;

use BackedEnum;

/**
 * @template TValue
 */
trait HasRandom {
    /**
     * Returns a random case of the enum.
     */
    public static function random(): static {
        return static::cases()[array_rand(static::cases())];
    }

    /**
     * Returns a random case value of the enum, for backed enums.
     * Returns a random case of the enum for pure enums.
     *
     * @return TValue|static
     */
    public static function randomValue(): mixed {
        if (is_a(static::class, BackedEnum::class, true)) {
            return static::random()->value;
        }

        return static::random();
    }

    /**
     * Returns a random case name of the enum.
     */
    public static function randomCaseName(): string {
        return static::random()->name;
    }
}
