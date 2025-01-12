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
}
