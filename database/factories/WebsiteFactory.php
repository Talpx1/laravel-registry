<?php

namespace Talp1\LaravelRegistry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Talp1\LaravelRegistry\Models\Website;
use Talp1\LaravelRegistry\Tests\Fakes\Models\FakeUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Website>
 */
class WebsiteFactory extends Factory {
    protected $model = Website::class;

    public function definition(): array {
        /** @var string */
        $morph_name = config('registry.database.morph_names.website_owner');

        return [
            'title' => fake()->words(rand(1, 6), true),
            'url' => fake()->url(),
            'notes' => fake()->paragraph(),
            "{$morph_name}_id" => FakeUser::create()->id,
            "{$morph_name}_type" => FakeUser::class,
        ];
    }
}
