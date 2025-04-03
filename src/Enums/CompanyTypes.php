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
 * Enum of company types.
 *
 * Being quite a difficult categorization to provide, this enum may be incomplete or inaccurate.
 * If you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
// TODO: test
enum CompanyTypes: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case CORPORATE_GROUP = 'corporate group';
    case BUSINESS_GROUP = 'business group';
    case PARENT_ORGANIZATION = 'parent organization';
    case HOLDING_STRUCTURE = 'holding structure';
    case ENTERPRISE_GROUP = 'enterprise group';
    case INVESTMENT_GROUP = 'investment group';
    case CONGLOMERATE = 'conglomerate';
    case FINANCIAL_HOLDING = 'financial holding';
    case PRIVATE_EQUITY_FIRM = 'private equity firm';
    case VENTURE_CAPITAL_FIRM = 'venture capital firm';
    case KEIRETSU = 'keiretsu';
    case OPERATING = 'operating';
    case SUBSIDIARY = 'subsidiary';
    case GOVERNMENT_OWNED_CORPORATION = 'government-owned corporation';
    case NONPROFIT_ORGANIZATION = 'nonprofit organization';

    public function description(): string {
        return match ($this) {
            self::HOLDING_STRUCTURE => 'A company that primarily owns shares in other companies, often without direct involvement in operations.',
            self::OPERATING => 'A company engaged in producing goods or providing services, as opposed to just holding assets.',
            self::SUBSIDIARY => 'A company controlled by another company (often a holding or parent company).',
            self::PARENT_ORGANIZATION => 'A company that owns and controls one or more subsidiaries.',
            self::CONGLOMERATE => 'A large corporation that owns businesses across multiple industries.',
            self::INVESTMENT_GROUP => 'A company that pools capital from investors to invest in securities, real estate, or other assets (e.g., mutual funds, private equity firms).',
            self::VENTURE_CAPITAL_FIRM => 'A company that invests in early-stage startups in exchange for equity.',
            self::PRIVATE_EQUITY_FIRM => 'A company that acquires and manages businesses, often restructuring them for higher profitability.',
            self::NONPROFIT_ORGANIZATION => 'A company that operates for a social or charitable cause rather than for profit.',
            self::GOVERNMENT_OWNED_CORPORATION => 'A company owned and operated by the government (e.g., national postal services, public transportation).',
            self::CORPORATE_GROUP => 'A collection of companies under common ownership or control, often structured with a parent company and subsidiaries.',
            self::BUSINESS_GROUP => 'A network of legally independent companies that operate under a common ownership or strategic alliance, often seen in family-owned or conglomerate structures.',
            self::ENTERPRISE_GROUP => 'Companies linked by ownership or control',
            self::FINANCIAL_HOLDING => 'A type of holding company primarily focused on controlling banks, investment firms, and other financial institutions.',
            self::KEIRETSU => 'Large, family-controlled or interlinked corporate groups in South Korea and Japan.',
        };
    }
}
