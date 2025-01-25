<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property-read int $id
 * @property string|null $title
 * @property string $street
 * @property string $civic_number
 * @property string $postal_code
 * @property string $city
 * @property \Talp1\LaravelRegistry\Enums\Countries $country
 * @property string|null $notes
 * @property string $address_owner_id
 * @property string $address_owner_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $formatted
 * @property Model $owner
 */
class Address extends Model {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'street',
        'civic_number',
        'postal_code',
        'city',
        'country',
        'notes',
    ];

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->fillable = [
            ...$this->fillable,
            config('registry.database.morph_names.address_owner').'_id',
            config('registry.database.morph_names.address_owner').'_type',
        ];

        /** @var string|null $addresses_table */
        $addresses_table = config('registry.database.table_names.addresses');
        $this->table = $addresses_table ?: parent::getTable();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        /** @var class-string $countries_enum */
        $countries_enum = config('registry.enums.countries');

        return [
            'country' => $countries_enum,
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

    /**
     * @return MorphTo<\Illuminate\Database\Eloquent\Model, $this>
     */
    public function owner(): MorphTo {
        /** @var string */
        $address_morph_name = config('registry.database.morph_names.address_owner');

        return $this->morphTo($address_morph_name);
    }
}
