<?php

namespace Talp1\LaravelRegistry\Enums\Traits;

trait ConvertsValueToLabel {
    public function label(): string {
        return ucwords($this->value);
    }
}
