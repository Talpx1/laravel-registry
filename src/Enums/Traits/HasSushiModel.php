<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 */
trait HasSushiModel {
    use GuessesModelClass;

    /**
     * Returns the model instance for this case.
     *
     * @return TModel
     */
    public function model(): Model {
        $model = self::getOrGuessModelClass();

        /** @var TModel */
        return $model::findOrFail($this->value);
    }
}
