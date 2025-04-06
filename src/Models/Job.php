<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Talp1\LaravelRegistry\Models\Contracts\EnumModel;

/**
 * @extends EnumModel<\Talp1\LaravelRegistry\Enums\Jobs>
 *
 * @property-read string $label
 */
class Job extends EnumModel {
    /**
     * @param  \Talp1\LaravelRegistry\Enums\Jobs  $case
     * @return array{id: string, label: string}
     */
    protected function enumMappings(\BackedEnum $case): array {
        return [
            'id' => $case->value,
            'label' => $case->label(),
        ];
    }
}
