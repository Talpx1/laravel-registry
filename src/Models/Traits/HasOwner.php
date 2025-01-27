<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait HasOwner {
    /**
     * @return MorphTo<\Illuminate\Database\Eloquent\Model, $this>
     */
    public function owner(): MorphTo {
        /** @var string */
        $morph_name = config("registry.database.morph_names.{$this->model_name}_owner");

        return $this->morphTo($morph_name);
    }
}
