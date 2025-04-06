<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait GuessesModelClass {
    private static function guessModelClass(): string {
        return 'App\\Models\\'.Str::singular(class_basename(__CLASS__));
    }

    /** @return class-string<\Illuminate\Database\Eloquent\Model> */
    private static function getOrGuessModelClass(): string {
        // @phpstan-ignore-next-line function.impossibleType
        if (method_exists(static::class, 'getModelClass')) {
            return static::getModelClass();
        }

        $partial_config_key = str(class_basename(static::class))->singular()->lower()->toString();
        $model_config_key = "registry.models.{$partial_config_key}";

        $model = config($model_config_key, static::guessModelClass());

        if (! is_string($model)) {
            throw new \Exception("{$model_config_key} config must be a model class-string.");
        }

        if (! class_exists($model)) {
            throw new \Exception('Model for enum '.__CLASS__." could not be guessed ({$model} model does not exist).");
        }

        if (! is_a($model, Model::class, true)) {
            throw new \Exception('Guessing model for enum '.__CLASS__.": {$model} found, but it's not a subclass ".Model::class.'.');
        }

        /** @var class-string<\Illuminate\Database\Eloquent\Model> */
        return $model;
    }
}
