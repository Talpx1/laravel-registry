<?php

namespace Talp1\LaravelRegistry\Enums\Traits;

use Illuminate\Support\Collection;

/**
 * @template T
 */
trait CanBeCollected {
    /**
     * @return T[]
     */
    public static function valuesToArray(): array {
        return array_map(fn ($case) => $case->value, static::cases());
    }

    /**
     * @return Collection<int, T>
     */
    public static function values(): Collection {
        return collect(static::valuesToArray());
    }
}
