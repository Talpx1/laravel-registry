<?php

namespace Talp1\LaravelRegistry\Enums\Contracts;

use Illuminate\Support\Collection;

/**
 * Only use in backed enums.
 *
 * @template T
 */
interface CanBeCollected {
    /**
     * Returns an array with the cases name as keys and the cases value as values for backed enums.
     * For pure enums, it will return an array of case names.
     *
     * @return array<string, T>
     */
    public static function toArray(): array;

    /**
     * Get the values of a backed enum as an array.
     *
     * @return T[]
     */
    public static function valuesToArray(): array;

    /**
     * Get the values of a backed enum as a collection.
     *
     * @return Collection<int, T>
     */
    public static function values(): Collection;

    /**
     * Get the case names of a backed enum as an array.
     *
     * @return T[]
     */
    public static function caseNamesToArray(): array;

    /**
     * Get the case names of a backed enum as a collection.
     *
     * @return Collection<int, T>
     */
    public static function caseNames(): Collection;
}
