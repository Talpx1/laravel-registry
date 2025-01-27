<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Talp1\LaravelRegistry\Models\Contracts\BaseModel;
use Talp1\LaravelRegistry\Models\Traits\HasOwner;

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
class Website extends BaseModel {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\WebsiteFactory> */
    use HasFactory, HasOwner;
}
