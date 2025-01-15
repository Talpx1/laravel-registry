<?php

namespace Talp1\LaravelRegistry\Enums\Traits;

use BackedEnum;
use Illuminate\Support\Collection;

/**
 * @template TValue
 */
trait CanBeCollected {
    /**
     * Returns an array with the cases name as keys and the cases value as values for backed enums.
     * For pure enums, it will return an array of case names.
     *
     * @return array<string, TValue>
     */
    public static function toArray(): array {
        $array = [];

        if (! is_a(static::class, BackedEnum::class, true)) {
            return static::caseNamesToArray();
        }

        foreach (static::cases() as $case) {
            $array[$case->name] = $case->value;
        }

        return $array;
    }

    /**
     * Get the values as an array.
     *
     * @return TValue[]
     */
    public static function valuesToArray(): array {
        return array_map(fn ($case) => $case->value, static::cases());
    }

    /**
     * Get the values as a collection.
     *
     * @return Collection<int, TValue>
     */
    public static function values(): Collection {
        return collect(static::valuesToArray());
    }

    /**
     * Get the case names as an array.
     *
     * @return string[]
     */
    public static function caseNamesToArray(): array {
        return array_map(fn ($case) => $case->name, static::cases());
    }

    /**
     * Get the case names as a collection.
     *
     * @return Collection<int, string>
     */
    public static function caseNames(): Collection {
        return collect(static::caseNamesToArray());
    }
}
