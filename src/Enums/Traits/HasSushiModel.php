<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Traits;

use BackedEnum;

trait HasSushiModel {
    /**
     * Returns an array to be used as Sushi model rows.
     * This array will use as IDs the case value, in a backed enum context, or the case name in a pure enum context
     *
     * @return array{id: string}[]
     */
    public static function sushiArray(): array {
        return array_map(fn ($case) => ['id' => is_a(self::class, BackedEnum::class, true) ? $case->value : $case->name], self::cases());
    }
}
