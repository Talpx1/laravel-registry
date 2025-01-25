<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property-read int $id
 * @property string $email_address_owner_id
 * @property string $email_address_owner_type
 * @property string|null $title
 * @property bool $email_address
 * @property \Talp1\LaravelRegistry\Enums\EmailAddressProviders|null $provider
 * @property bool $is_certified
 * @property bool $is_no_reply
 * @property bool $is_operated_by_human
 * @property string|null $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property Model $owner
 */
class EmailAddress extends Model {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\EmailAddressFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'email_address',
        'provider',
        'is_certified',
        'is_no_reply',
        'is_operated_by_human',
        'notes',
    ];

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->fillable = [
            ...$this->fillable,
            config('registry.database.morph_names.email_address_owner').'_id',
            config('registry.database.morph_names.email_address_owner').'_type',
        ];

        /** @var string|null $email_addresses_table */
        $email_addresses_table = config('registry.database.table_names.email_addresses');
        $this->table = $email_addresses_table ?: parent::getTable();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        /** @var class-string $email_address_providers_enum */
        $email_address_providers_enum = config('registry.enums.email_address_providers');

        return [
            'provider' => $email_address_providers_enum,
        ];
    }

    /**
     * @return MorphTo<\Illuminate\Database\Eloquent\Model, $this>
     */
    public function owner(): MorphTo {
        /** @var string */
        $email_address_morph_name = config('registry.database.morph_names.email_address_owner');

        return $this->morphTo($email_address_morph_name);
    }
}
