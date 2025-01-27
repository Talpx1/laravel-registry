<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Talp1\LaravelRegistry\Models\Contracts\BaseModel;
use Talp1\LaravelRegistry\Models\Traits\HasOwner;

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
class EmailAddress extends BaseModel {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\EmailAddressFactory> */
    use HasFactory, HasOwner;

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
}
