<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
interface HasSushiModel {
    /**
     * Returns the model instance for this case.
     *
     * @return TModel
     */
    public function model(): Model;
}
