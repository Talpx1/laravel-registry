<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Contracts;

/**
 * @template TValue
 */
interface HasRandom {
    /**
     * Returns a random case or an array of random cases of the enum.
     *
     * @return ($amount is 1 ? static[] : static)
     *
     * @throws \InvalidArgumentException when `$amount` < 1
     */
    public static function random(int $amount = 1): static|array;

    /**
     * Returns a random case value of the enum, for backed enums.
     * Returns a random case of the enum for pure enums.
     *
     * @return TValue|static
     */
    public static function randomValue(): mixed;

    /**
     * Returns a random case name of the enum.
     */
    public static function randomCaseName(): string;
}
