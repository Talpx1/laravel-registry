<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Traits;

trait HasSushiModel {
    /**
     * Returns an array to be used as Sushi model rows.
     * This array will use as IDs the case value in a backed enum context.
     * Pure enums are not supported.
     *
     * @return array{id: string}[]
     *
     * @throws \Exception if the current class is not a backed enum
     */
    public static function sushiArray(): array {
        if (is_a(static::class, \BackedEnum::class, true)) {
            throw new \Exception('Only backed enums can be used as Sushi model. '.__CLASS__.' is not a baked enum.');
        }

        return array_map(fn ($case) => ['id' => $case->value], self::cases());
    }
}
