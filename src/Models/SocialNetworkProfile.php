<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Talp1\LaravelRegistry\Models\Contracts\BaseModel;
use Talp1\LaravelRegistry\Models\Traits\HasOwner;

/**
 * @property-read int $id
 * @property string $social_network_profile_owner_id
 * @property string $social_network_profile_owner_type
 * @property \Talp1\LaravelRegistry\Enums\SocialNetworks $social_network
 * @property string|null $title
 * @property string $url
 * @property string|null $username
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $handle
 * @property Model $owner
 */
class SocialNetworkProfile extends BaseModel {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\SocialNetworkProfileFactory> */
    use HasFactory, HasOwner;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        /** @var class-string $social_network_enum */
        $social_network_enum = config('registry.enums.social_networks');

        return [
            'social_network' => $social_network_enum,
        ];
    }

    /** @return Attribute<string, never> */
    protected function handle(): Attribute {
        return Attribute::get(fn (): string => $this->social_network->handlePrefix().$this->username);
    }
}
