<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Contracts\HasRandom;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\HasRandom as HasRandomTrait;

/**
 * Enum of blood types.
 *- {@link https://www.redcrossblood.org/donate-blood/blood-types.html}
 *- {@link https://en.wikipedia.org/wiki/Blood_type}
 *
 * If you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum BloodTypes: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, HasRandomTrait;

    case A_POSITIVE = 'A+';
    case A_NEGATIVE = 'A-';
    case B_POSITIVE = 'B+';
    case B_NEGATIVE = 'B-';
    case O_POSITIVE = 'O+';
    case O_NEGATIVE = 'O-';
    case AB_POSITIVE = 'AB+';
    case AB_NEGATIVE = 'AB-';

    public function label(): string {
        return $this->value;
    }

    /**
     * Returns an array of compatible donors for the current blood type.
     *
     * @return BloodTypes[]
     */
    public function compatibleDonors(): array {
        return match ($this) {
            self::A_POSITIVE => [self::A_POSITIVE, self::A_NEGATIVE, self::O_POSITIVE, self::O_NEGATIVE],
            self::A_NEGATIVE => [self::A_NEGATIVE, self::O_NEGATIVE],
            self::B_POSITIVE => [self::B_POSITIVE, self::B_NEGATIVE, self::O_POSITIVE, self::O_NEGATIVE],
            self::B_NEGATIVE => [self::B_NEGATIVE, self::O_NEGATIVE],
            self::O_POSITIVE => [self::O_POSITIVE, self::O_NEGATIVE],
            self::O_NEGATIVE => [self::O_NEGATIVE],
            self::AB_POSITIVE => self::cases(),
            self::AB_NEGATIVE => [self::A_NEGATIVE, self::B_NEGATIVE, self::O_NEGATIVE, self::AB_NEGATIVE],
        };
    }

    /**
     * Returns an array of compatible receivers for the current blood type.
     *
     * @return BloodTypes[]
     */
    public function compatibleReceivers(): array {
        return match ($this) {
            self::A_POSITIVE => [self::A_POSITIVE, self::AB_POSITIVE],
            self::A_NEGATIVE => [self::A_NEGATIVE, self::A_POSITIVE, self::AB_POSITIVE, self::AB_NEGATIVE],
            self::B_POSITIVE => [self::B_POSITIVE, self::AB_POSITIVE],
            self::B_NEGATIVE => [self::B_NEGATIVE, self::B_POSITIVE, self::AB_POSITIVE, self::AB_NEGATIVE],
            self::O_POSITIVE => [self::O_POSITIVE, self::A_POSITIVE, self::B_POSITIVE, self::AB_POSITIVE],
            self::O_NEGATIVE => self::cases(),
            self::AB_POSITIVE => [self::AB_POSITIVE],
            self::AB_NEGATIVE => [self::AB_POSITIVE, self::AB_NEGATIVE],
        };
    }

    public function canReceiveFrom(BloodTypes $type): bool {
        return in_array($type, $this->compatibleDonors());
    }

    public function canDonateTo(BloodTypes $type): bool {
        return in_array($type, $this->compatibleReceivers());
    }

    /**
     * Returns an array of compatible plasma donors for the current blood type.
     *
     * @return BloodTypes[]
     */
    public function compatiblePlasmaDonors(): array {
        return match ($this) {
            self::A_POSITIVE, self::A_NEGATIVE => [self::A_POSITIVE, self::A_NEGATIVE, self::AB_POSITIVE, self::AB_NEGATIVE],
            self::B_POSITIVE, self::B_NEGATIVE => [self::B_POSITIVE, self::B_NEGATIVE, self::AB_POSITIVE, self::AB_NEGATIVE],
            self::O_POSITIVE, self::O_NEGATIVE => self::cases(),
            self::AB_POSITIVE, self::AB_NEGATIVE => [self::AB_NEGATIVE, self::AB_NEGATIVE],
        };
    }

    /**
     * Returns an array of compatible plasma receivers for the current blood type.
     *
     * @return BloodTypes[]
     */
    public function compatiblePlasmaReceivers(): array {
        return match ($this) {
            self::A_POSITIVE, self::A_NEGATIVE => [self::A_NEGATIVE, self::A_POSITIVE, self::O_POSITIVE, self::O_NEGATIVE],
            self::B_POSITIVE, self::B_NEGATIVE => [self::B_NEGATIVE, self::B_POSITIVE, self::O_POSITIVE, self::O_NEGATIVE],
            self::O_POSITIVE, self::O_NEGATIVE => [self::O_NEGATIVE, self::O_POSITIVE],
            self::AB_POSITIVE, self::AB_NEGATIVE => self::cases(),
        };
    }

    public function canReceivePlasmaFrom(BloodTypes $type): bool {
        return in_array($type, $this->compatiblePlasmaDonors());
    }

    public function canDonatePlasmaTo(BloodTypes $type): bool {
        return in_array($type, $this->compatiblePlasmaReceivers());
    }
}
