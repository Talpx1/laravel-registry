<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Traits;

trait ConvertsValueToLabel {
    /**
     * Returns a label for the given case
     */
    public function label(): string {
        return ucwords($this->value);
    }
}
