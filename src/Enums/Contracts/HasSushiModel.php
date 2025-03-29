<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Contracts;

interface HasSushiModel {
    /**
     * Returns an array to be used as Sushi model rows.
     * This array will use as IDs the case value, in a backed enum context, or the case name in a pure enum context
     *
     * @return array{id: string}[]
     */
    public static function sushiArray(): array;
}
