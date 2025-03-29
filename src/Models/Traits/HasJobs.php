<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasJobs {
    /** @return BelongsToMany<\Illuminate\Database\Eloquent\Model, $this> */
    public function jobs(): BelongsToMany {
        /** @var class-string<\Illuminate\Database\Eloquent\Model> */
        $model = config('registry.models.job');

        return $this->belongsToMany($model)->withPivot('company_id');
    }
}
