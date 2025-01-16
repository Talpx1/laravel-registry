<?php

namespace Talp1\LaravelRegistry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Models\Address;
use Talp1\LaravelRegistry\Tests\Fakes\Models\FakeUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Address>
 */
class AddressFactory extends Factory {
    protected $model = Address::class;

    public function definition(): array {
        /** @var string */
        $morph_name = config('registry.database.morph_names.address_owner');

        return [
            'title' => fake()->words(rand(1, 6), true),
            'street' => fake()->streetName(),
            'civic_number' => fake()->buildingNumber(),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'country' => Countries::randomValue(),
            'notes' => fake()->paragraph(),
            "{$morph_name}_id" => FakeUser::create()->id,
            "{$morph_name}_type" => FakeUser::class,
        ];
    }
}
