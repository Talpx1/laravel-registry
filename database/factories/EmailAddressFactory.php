<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Talp1\LaravelRegistry\Enums\EmailAddressProviders;
use Talp1\LaravelRegistry\Models\EmailAddress;
use Talp1\LaravelRegistry\Tests\Fakes\Models\FakeUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EmailAddress>
 */
class EmailAddressFactory extends Factory {
    protected $model = EmailAddress::class;

    public function definition(): array {
        /** @var string */
        $morph_name = config('registry.database.morph_names.email_address_owner');

        return [
            'title' => fake()->words(rand(1, 6), true),
            'email_address' => fake()->safeEmail(),
            'provider' => EmailAddressProviders::randomValue(),
            'is_certified' => fake()->boolean(),
            'is_no_reply' => fake()->boolean(),
            'is_operated_by_human' => fake()->boolean(),
            'notes' => fake()->paragraph(),
            "{$morph_name}_id" => FakeUser::create()->id,
            "{$morph_name}_type" => FakeUser::class,
        ];
    }

    public function isCertified(bool $is_certified = true): self {
        return $this->state(fn (): array => ['is_certified' => $is_certified]);
    }

    public function isNoReply(bool $is_no_reply = true): self {
        return $this->state(fn (): array => ['is_no_reply' => $is_no_reply]);
    }

    public function isOperatedByHuman(bool $is_operated_by_human = true): self {
        return $this->state(fn (): array => ['is_operated_by_human' => $is_operated_by_human]);
    }

    public function forProvider(EmailAddressProviders $provider): self {
        return $this->state(fn (): array => ['provider' => $provider->value]);
    }
}
