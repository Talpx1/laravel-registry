<?php

namespace Talp1\LaravelRegistry\Enums\Contracts;

interface HasLabels {
    /**
     * Returns a label for the given case
     */
    public function label(): string;
}
