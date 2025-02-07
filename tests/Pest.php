<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in(__DIR__);

require_once __DIR__.'/utils/helpers.php';
require_once __DIR__.'/utils/schema_assertions.php';
require_once __DIR__.'/utils/casing_expectations.php';

// expect collection of models contains the provided collection of models
expect()->intercept(
    'toContain',
    fn ($value) => is_a($value, Collection::class) && $value->every(fn ($entry) => is_a($entry, Model::class)),
    fn (Collection $models) => expect($this->value->pluck('id'))->toContain(...$models->pluck('id')->toArray())
);

// expect the provided model to be the same model
expect()->intercept('toBe', Model::class, function (Model $expected) {
    expect($this->value->id)->toBe($expected->id);
});
