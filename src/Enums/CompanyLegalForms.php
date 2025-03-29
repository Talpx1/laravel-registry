<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Contracts\HasRandom;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\HasRandom as HasRandomTrait;

/**
 * Enum of company legal forms.
 * These values are based on ISO 20275 ({@link https://www.gleif.org/en/about-lei/code-lists/iso-20275-entity-legal-forms-code-list/}).
 *
 * If you find an error, an inconsistency or you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum CompanyLegalForms: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, HasRandomTrait;

    // TODO

    public function elfCode(): string {
        return match ($this) {
        };
    }

    public function countryOfFormation(): Countries {
        return match ($this) {
        };
    }

    public function abbreviation(): string {
        return match ($this) {
        };
    }

    public function abbreviationInLocalLanguage(): string {
        return match ($this) {
        };
    }

    public function label(): string {
        return match ($this) {
        };
    }

    public function labelInLocalLanguage(): string {
        return match ($this) {
        };
    }
}
