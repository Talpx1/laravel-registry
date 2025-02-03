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
 * These value are based on the Monk scale, developed by Ellis Monk in partnership with Google and released in 2023.
 * - {@link https://en.wikipedia.org/wiki/Monk_Skin_Tone_Scale},
 * - {@link https://skintone.google/get-started}
 *
 * Note that some other scales do exist:
 * - Fitzpatrick scale: https://en.wikipedia.org/wiki/Fitzpatrick_scale
 * - Von Luschan's chromatic scale: https://en.wikipedia.org/wiki/Von_Luschan%27s_chromatic_scale
 *
 * If you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum SkinTones: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case LIGHT_1 = 'light 1';
    case LIGHT_2 = 'light 2';
    case LIGHT_3 = 'light 3';
    case MEDIUM_4 = 'medium 4';
    case MEDIUM_5 = 'medium 5';
    case MEDIUM_6 = 'medium 6';
    case DARK_7 = 'dark 7';
    case DARK_8 = 'dark 8';
    case DARK_9 = 'dark 9';
    case DARK_10 = 'dark 10';

    /**
     *  Returns a hex code for the skin tone.
     *
     * @link https://skintone.google/get-started
     */
    public function hexColorCode(): string {
        return match ($this) {
            self::LIGHT_1 => '#f6ede4',
            self::LIGHT_2 => '#f3e7db',
            self::LIGHT_3 => '#f7ead0',
            self::MEDIUM_4 => '#eadaba',
            self::MEDIUM_5 => '#d7bd96',
            self::MEDIUM_6 => '#a07e56',
            self::DARK_7 => '#825c43',
            self::DARK_8 => '#604134',
            self::DARK_9 => '#3a312a',
            self::DARK_10 => '#292420',
        };
    }
}
