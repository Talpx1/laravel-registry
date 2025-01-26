<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Traits;

trait ConvertsValueToLabel {
    /**
     * Returns a label for the given case
     */
    public function label(): string {
        return ucwords(str_starts_with($this->value, '_') ? substr($this->value, 1) : $this->value);
    }
}
