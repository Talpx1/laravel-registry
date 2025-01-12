<?php

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\ConvertsValueToLabel;

/** @implements CanBeCollected<string> */
enum Continents: string implements CanBeCollected, HasLabels {
    /** @use CanBeCollectedTrait<string> */
    use CanBeCollectedTrait, ConvertsValueToLabel;

    case AFRICA = 'africa';
    case ANTARCTICA = 'antarctica';
    case ASIA = 'asia';
    case EUROPE = 'europe';
    case NORTH_AMERICA = 'north america';
    case OCEANIA = 'oceania';
    case SOUTH_AMERICA = 'south america';
}
