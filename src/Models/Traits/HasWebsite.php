<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasWebsite {
    /** @return MorphMany<\Illuminate\Database\Eloquent\Model, $this> */
    public function websites(): MorphMany {
        /** @var class-string<\Illuminate\Database\Eloquent\Model> */
        $model = config('registry.models.website');
        /** @var string */
        $morph_name = config('registry.database.morph_names.website_owner');

        return $this->morphMany($model, $morph_name);
    }
}
