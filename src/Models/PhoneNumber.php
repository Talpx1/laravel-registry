<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Talp1\LaravelRegistry\Enums\PhoneLineTypes;
use Talp1\LaravelRegistry\Models\Contracts\BaseModel;
use Talp1\LaravelRegistry\Models\Traits\HasOwner;

/**
 * @property-read int $id
 * @property string $phone_number_owner_id
 * @property string $phone_number_owner_type
 * @property string|null $title
 * @property PhoneLineTypes $line_type
 * @property string|null $prefix
 * @property string $phone_number
 * @property bool $accepts_sms
 * @property bool $accepts_calls
 * @property bool $accepts_faxes
 * @property bool $is_receive_only
 * @property bool $is_operated_by_human
 * @property string|null $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property Model $owner
 */
class PhoneNumber extends BaseModel {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\PhoneNumberFactory> */
    use HasFactory, HasOwner;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        /** @var class-string $phone_line_types_enum */
        $phone_line_types_enum = config('registry.enums.phone_line_types');

        return [
            'line_type' => $phone_line_types_enum,
        ];
    }

    /** @return Attribute<string, never> */
    protected function prefixed(): Attribute {
        return Attribute::get(fn () => $this->prefix === null ? $this->phone_number : "+{$this->prefix} {$this->phone_number}");
    }
}
