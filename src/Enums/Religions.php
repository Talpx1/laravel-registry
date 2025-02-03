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
 * Enum of Religions.
 * Note that only the major religions are included in this enum {@link https://en.wikipedia.org/wiki/Major_religious_groups}.
 * Several other religions exists but mapping them all would be a really huge work {@link https://en.wikipedia.org/wiki/List_of_religions_and_spiritual_traditions}.
 *
 * If you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum Religions: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case CHRISTIANITY = 'christianity';
    case ISLAM = 'islam';
    case HINDUISM = 'hinduism';
    case BUDDHISM = 'buddhism';
    case FOLK_RELIGION = 'folk religion';
    case SHINTO = 'shinto';
    case TAOISM = 'taoism';
    case YORUBA_RELIGION = 'yoruba religion';
    case VOODOO = 'voodoo';
    case SIKHISM = 'sikhism';
    case JUDAISM = 'judaism';
    case SPIRITISM = 'spiritism';
    case MU_ISM = 'mu-ism';
    case CONFUCIANISM = 'confucianism';
    case BAHAI_FAITH = 'bahá\'í faith';
    case JAINISM = 'jainism';
    case CHEONDOISM = 'cheondoism';
    case HOAHAOISM = 'hoahaoism';
    case CAODAISM = 'caodaism';
    case TENRIISM = 'tenriism';
    case DRUZE = 'druze';
}
