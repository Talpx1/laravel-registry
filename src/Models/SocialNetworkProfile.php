<?php

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property-read int $id
 * @property string $social_network_profile_owner_id
 * @property string $social_network_profile_owner_type
 * @property \Talp1\LaravelRegistry\Enums\SocialNetworks $social_network
 * @property string|null $title
 * @property string $url
 * @property string|null $username
 * @property string|null $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $handle
 * @property Model $owner
 */
class SocialNetworkProfile extends Model {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\SocialNetworkProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'social_network',
        'title',
        'url',
        'username',
        'notes',
    ];

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->fillable = [
            ...$this->fillable,
            config('registry.database.morph_names.social_network_profile_owner').'_id',
            config('registry.database.morph_names.social_network_profile_owner').'_type',
        ];

        /** @var string|null $social_network_profiles_table */
        $social_network_profiles_table = config('registry.database.table_names.social_network_profiles');
        $this->table = $social_network_profiles_table ?: parent::getTable();
    }

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

    /**
     * @return MorphTo<\Illuminate\Database\Eloquent\Model, $this>
     */
    public function owner(): MorphTo {
        /** @var string */
        $address_morph_name = config('registry.database.morph_names.social_network_profile_owner');

        return $this->morphTo($address_morph_name);
    }
}
