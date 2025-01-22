<?php

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Talp1\LaravelRegistry\Enums\PhoneLineTypes;

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
class PhoneNumber extends Model {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\PhoneNumberFactory> */
    use HasFactory;

    protected $fillable = [
        'line_type',
        'title',
        'prefix',
        'phone_number',
        'accepts_sms',
        'accepts_calls',
        'accepts_faxes',
        'is_receive_only',
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
            config('registry.database.morph_names.phone_number_owner').'_id',
            config('registry.database.morph_names.phone_number_owner').'_type',
        ];

        /** @var string|null $phone_numbers_table */
        $phone_numbers_table = config('registry.database.table_names.phone_numbers');
        $this->table = $phone_numbers_table ?: parent::getTable();
    }

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

    /**
     * @return MorphTo<\Illuminate\Database\Eloquent\Model, $this>
     */
    public function owner(): MorphTo {
        /** @var string */
        $phone_number_morph_name = config('registry.database.morph_names.phone_number_owner');

        return $this->morphTo($phone_number_morph_name);
    }
}
