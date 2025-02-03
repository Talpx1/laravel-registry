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
 * Enum of eye colors.
 * These value are based on the Martin-Shultz scale {@link https://en.wikipedia.org/wiki/Martin%E2%80%93Schultz_scale}.
 * Some out-of-scale values are included: Heterochromia.
 *
 * If you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum EyeColors: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case PALE_BLUE_IRIS = 'pale-blue iris';
    case LIGHT_BLUE_IRIS = 'light-blue iris';
    case SKY_BLUE_IRIS = 'sky-blue iris';
    case BLUE_IRIS = 'blue iris';
    case DARK_BLUE_IRIS = 'dark-blue iris';
    case BLUE_GRAY_IRIS = 'blue-gray iris';
    case LIGHT_GRAY_IRIS = 'light-gray iris';
    case DARK_GRAY_IRIS = 'dark-gray iris';
    case BLUE_GRAY_IRIS_WITH_YELLOW_OR_BROWN_SPOTS = 'blue-gray iris with yellow/brown spots';
    case GRAY_GREEN_IRIS_WITH_YELLOW_OR_BROWN_SPOTS = 'gray-green iris with yellow/brown spots';
    case GREEN_IRIS = 'green iris';
    case GREEN_IRIS_WITH_YELLOW_OR_BROWN_SPOTS = 'green iris with yellow/brown spots';
    case AMBER_IRIS = 'amber iris';
    case HAZEL_IRIS = 'hazel iris';
    case LIGHT_BROWN_IRIS = 'light-brown iris';
    case MEDIUM_BROWN_IRIS = 'medium-brown iris';
    case DARK_BROWN_IRIS = 'dark-brown iris';
    case MAHOGANY_IRIS = 'mahogany iris';
    case BLACK_BROWN_IRIS = 'black-brown iris';
    case BLACK_IRIS = 'black iris';
    case HETEROCHROMIA = 'heterochromia';

    /**
     * Returns the Martin Shultz scale value for the eye color.
     * Out-of-scale values are returned as null.
     *
     * @link https://en.wikipedia.org/wiki/Martin%E2%80%93Schultz_scale
     */
    public function martinShultzScaleValue(): ?string {
        return match ($this) {
            self::PALE_BLUE_IRIS => '1a',
            self::LIGHT_BLUE_IRIS => '1b',
            self::SKY_BLUE_IRIS => '1c',
            self::BLUE_IRIS => '2a',
            self::DARK_BLUE_IRIS => '2b',
            self::BLUE_GRAY_IRIS => '3',
            self::LIGHT_GRAY_IRIS => '4a',
            self::DARK_GRAY_IRIS => '4b',
            self::BLUE_GRAY_IRIS_WITH_YELLOW_OR_BROWN_SPOTS => '5',
            self::GRAY_GREEN_IRIS_WITH_YELLOW_OR_BROWN_SPOTS => '6',
            self::GREEN_IRIS => '7',
            self::GREEN_IRIS_WITH_YELLOW_OR_BROWN_SPOTS => '8',
            self::AMBER_IRIS => '9',
            self::HAZEL_IRIS => '10',
            self::LIGHT_BROWN_IRIS => '11',
            self::MEDIUM_BROWN_IRIS => '12',
            self::DARK_BROWN_IRIS => '13',
            self::MAHOGANY_IRIS => '14',
            self::BLACK_BROWN_IRIS => '15',
            self::BLACK_IRIS => '16',
            default => null
        };
    }

    /**
     * Returns the approximate hex code value for the eye color.
     * Out-of-scale values are returned as null.
     *
     * @link https://en.wikipedia.org/wiki/Martin%E2%80%93Schultz_scale
     */
    public function hexColorCode(): ?string {
        return match ($this) {
            self::PALE_BLUE_IRIS => '#B3D9FF',
            self::LIGHT_BLUE_IRIS => '#99CCFF',
            self::SKY_BLUE_IRIS => '#6699CC',
            self::BLUE_IRIS => '#336699',
            self::DARK_BLUE_IRIS => '#003366',
            self::BLUE_GRAY_IRIS => '#A8C3D1',
            self::LIGHT_GRAY_IRIS => '#BEBEBE',
            self::DARK_GRAY_IRIS => '#A9A9A9',
            self::BLUE_GRAY_IRIS_WITH_YELLOW_OR_BROWN_SPOTS => '#C0C080',
            self::GRAY_GREEN_IRIS_WITH_YELLOW_OR_BROWN_SPOTS => '#8F9779',
            self::GREEN_IRIS => '#6B8E23',
            self::GREEN_IRIS_WITH_YELLOW_OR_BROWN_SPOTS => '#808000',
            self::AMBER_IRIS => '#C4A484',
            self::HAZEL_IRIS => '#A0522D',
            self::LIGHT_BROWN_IRIS => '#8B4513',
            self::MEDIUM_BROWN_IRIS => '#5A3A22',
            self::DARK_BROWN_IRIS => '#4B3621',
            self::MAHOGANY_IRIS => '#3B2F2F',
            self::BLACK_BROWN_IRIS => '#2B1B17',
            self::BLACK_IRIS => '#000000',
            default => null,
        };
    }
}
