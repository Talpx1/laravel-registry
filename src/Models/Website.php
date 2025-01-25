<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property-read int $id
 * @property string $website_owner_id
 * @property string $website_owner_type
 * @property string|null $title
 * @property string $url
 * @property string|null $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property Model $owner
 */
class Website extends Model {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\WebsiteFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'notes',
    ];

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->fillable = [
            ...$this->fillable,
            config('registry.database.morph_names.website_owner').'_id',
            config('registry.database.morph_names.website_owner').'_type',
        ];

        /** @var string|null $websites_table */
        $websites_table = config('registry.database.table_names.websites');
        $this->table = $websites_table ?: parent::getTable();
    }

    /**
     * @return MorphTo<\Illuminate\Database\Eloquent\Model, $this>
     */
    public function owner(): MorphTo {
        /** @var string */
        $website_morph_name = config('registry.database.morph_names.website_owner');

        return $this->morphTo($website_morph_name);
    }
}
