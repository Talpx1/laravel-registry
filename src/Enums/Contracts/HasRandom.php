<?php

namespace Talp1\LaravelRegistry\Enums\Contracts;

/**
 * @template TValue
 */
interface HasRandom {
    /**
     * Returns a random case of the enum.
     */
    public static function random(): static;

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
