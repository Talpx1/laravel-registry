<?php

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\ConvertsValueToLabel;

/**
 * Enum of all the continents in the world using the seven-continent model ({@link https://en.wikipedia.org/wiki/Continent#Number}).
 *
 * Note that, even though in the seven-continent model Australia is considered a continent, it falls under Oceania in this enum.
 * This choice was made based on these sources:
 * - r/geography Reddit Poll: {@link https://www.reddit.com/r/geography/comments/tp8hs0/oceania_or_australia_as_a_continent/}
 * - United Nations geoscheme: {@link https://en.wikipedia.org/wiki/United_Nations_geoscheme}.
 *  Even if it is a six-continent model, it recognizes Oceania as a continent and Australia as a sub-region
 *  ({@link https://en.wikipedia.org/wiki/United_Nations_geoscheme_for_Oceania}).
 * - To avoid confusion with the country Australia and have a more clear container for the isles of the region.
 *
 * @implements CanBeCollected<string>
 */
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
