<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Traits;

use BackedEnum;

/**
 * @template TValue
 */
trait HasRandom {
    /**
     * Returns a random case or an array of random cases of the enum.
     *
     * @return ($amount is 1 ? static : static[])
     *
     * @throws \InvalidArgumentException when `$amount` < 1
     */
    public static function random(int $amount = 1): static|array {
        if ($amount < 1) {
            throw new \InvalidArgumentException('Invalid amount: the minimum for random is 1.');
        }

        if ($amount === 1) {
            return static::cases()[array_rand(static::cases())];
        }

        $random_cases = [];

        foreach (array_rand(static::cases(), $amount) as $key) {
            $random_cases[] = static::cases()[$key];
        }

        return $random_cases;
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
