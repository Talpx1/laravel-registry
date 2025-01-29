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
 * @property string|null $title
 * @property string $street
 * @property string $civic_number
 * @property string $postal_code
 * @property string $city
 * @property \Talp1\LaravelRegistry\Enums\Countries $country
 * @property \Talp1\LaravelRegistry\Enums\SitePurposes $purpose
 * @property string|null $notes
 * @property string $address_owner_id
 * @property string $address_owner_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $formatted
 * @property Model $owner
 */
class Address extends BaseModel {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\AddressFactory> */
    use HasFactory, HasOwner;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        /** @var class-string $countries_enum */
        $countries_enum = config('registry.enums.countries');

        /** @var class-string $site_purposes_enum */
        $site_purposes_enum = config('registry.enums.site_purposes');

        return [
            'country' => $countries_enum,
            'purpose' => $site_purposes_enum,
        ];
    }

    /** @return Attribute<string, never> */
    protected function formatted(): Attribute {
        return Attribute::get(fn (): string => preg_replace_callback(
            '/\{(\w+)\}/',
            fn ($matches) => [...$this->attributesToArray(), 'country' => $this->country->label()][$matches[1]] ?? $matches[0],
            config('registry.address_format') // @phpstan-ignore argument.type
        ));
    }
}
