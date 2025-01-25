<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Enums\PhoneLineTypes;
use Talp1\LaravelRegistry\Models\PhoneNumber;
use Talp1\LaravelRegistry\Tests\Fakes\Models\FakeUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<PhoneNumber>
 */
class PhoneNumberFactory extends Factory {
    protected $model = PhoneNumber::class;

    public function definition(): array {
        /** @var string */
        $morph_name = config('registry.database.morph_names.phone_number_owner');

        return [
            'line_type' => PhoneLineTypes::randomValue(),
            'prefix' => Countries::random()->phonePrefix(),
            'phone_number' => fake()->e164PhoneNumber(),
            'accepts_sms' => fake()->boolean(),
            'accepts_calls' => fake()->boolean(),
            'accepts_faxes' => fake()->boolean(),
            'is_receive_only' => fake()->boolean(),
            'is_operated_by_human' => fake()->boolean(),
            'title' => fake()->words(rand(1, 6), true),
            'notes' => fake()->paragraph(),
            "{$morph_name}_id" => FakeUser::create()->id,
            "{$morph_name}_type" => FakeUser::class,
        ];
    }

    public function fixed(): self {
        return $this->state(fn (): array => ['line_type' => PhoneLineTypes::FIXED->value]);
    }

    public function mobile(): self {
        return $this->state(fn (): array => ['line_type' => PhoneLineTypes::MOBILE->value]);
    }

    public function withCountryPrefix(Countries $country): self {
        return $this->state(fn (): array => ['prefix' => $country->phonePrefix()]);
    }

    public function acceptsSMS(bool $accept = true): self {
        return $this->state(fn (): array => ['accepts_sms' => $accept]);
    }

    public function acceptsCalls(bool $accept = true): self {
        return $this->state(fn (): array => ['accepts_calls' => $accept]);
    }

    public function acceptsFaxes(bool $accept = true): self {
        return $this->state(fn (): array => ['accepts_faxes' => $accept]);
    }

    public function isReceiveOnly(bool $is_receive_only = true): self {
        return $this->state(fn (): array => ['is_receive_only' => $is_receive_only]);
    }

    public function isOperatedByHuman(bool $is_operated_by_human = true): self {
        return $this->state(fn (): array => ['is_operated_by_human' => $is_operated_by_human]);
    }
}
