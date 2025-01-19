<?php

namespace Talp1\LaravelRegistry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Talp1\LaravelRegistry\Enums\SocialNetworks;
use Talp1\LaravelRegistry\Models\SocialNetworkProfile;
use Talp1\LaravelRegistry\Tests\Fakes\Models\FakeUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<SocialNetworkProfile>
 */
class SocialNetworkProfileFactory extends Factory {
    protected $model = SocialNetworkProfile::class;

    public function definition(): array {
        /** @var string */
        $morph_name = config('registry.database.morph_names.social_network_profile_owner');

        return [
            'social_network' => SocialNetworks::randomValue(),
            'title' => fake()->words(rand(1, 6), true),
            'url' => fake()->url(),
            'username' => fake()->userName(),
            'notes' => fake()->paragraph(),
            "{$morph_name}_id" => FakeUser::create()->id,
            "{$morph_name}_type" => FakeUser::class,
        ];
    }
}
