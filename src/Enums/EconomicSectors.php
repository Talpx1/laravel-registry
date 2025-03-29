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
 * Enum of economic sectors ({@link https://en.wikipedia.org/wiki/Economic_sector}).
 *
 * If you find an error, an inconsistency or you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum EconomicSectors: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case PRIMARY = 'primary';
    case SECONDARY = 'secondary';
    case TERTIARY = 'tertiary';

    public function description(): string {
        return match ($this) {
            self::PRIMARY => 'Involves the retrieval and production of raw-material products, such as corn, coal, wood or iron. Miners, farmers and fishermen are all workers in the primary sector.',
            self::SECONDARY => 'Involves the transformation of raw or intermediate materials into goods, as in steel into cars, or textiles into clothing. Builders and dressmakers work in the secondary sector.',
            self::TERTIARY => 'Involves the supplying of services to consumers and businesses, such as babysitting, cinemas or banking. Shopkeepers and accountants work in the tertiary sector.',
        };
    }
}
