<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Contracts\HasRandom;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\ConvertsValueToLabel;
use Talp1\LaravelRegistry\Enums\Traits\HasRandom as HasRandomTrait;

/**
 * Enum of hair colors.
 * These value are based on the Fischer–Saller scale {@link https://en.wikipedia.org/wiki/Fischer%E2%80%93Saller_scale}.
 * Some out-of-scale values are included: Grey, White and Dyed that are not part of the original scale.
 *
 * If you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum HairColors: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case VERY_LIGHT_BLOND = 'very light blond';
    case LIGHT_BLOND = 'light blond';
    case BLOND = 'blond';
    case DARK_BLOND = 'dark blond';
    case LIGHT_BROWN_TO_MEDIUM_BROWN = 'light brown to medium brown';
    case DARK_BROWN_TO_BLACK = 'dark brown/black';
    case RED = 'red';
    case RED_BLOND = 'red blond';
    case GRAY = 'gray';
    case WHITE = 'white';
    case DYED = 'dyed';

    /**
     * Returns the Fischer–Saller scale range for this hair color.
     * The out-of-scale additional values return null.
     *
     * @link https://en.wikipedia.org/wiki/Fischer%E2%80%93Saller_scale
     */
    public function fischerSallerScaleRange(): ?string {
        return match ($this) {
            self::VERY_LIGHT_BLOND => 'A',
            self::LIGHT_BLOND => 'B-E',
            self::BLOND => 'F-L',
            self::DARK_BLOND => 'M-O',
            self::LIGHT_BROWN_TO_MEDIUM_BROWN => 'P-T',
            self::DARK_BROWN_TO_BLACK => 'U-Y',
            self::RED => 'I-IV',
            self::RED_BLOND => 'V-VI',
            default => null
        };
    }
}
