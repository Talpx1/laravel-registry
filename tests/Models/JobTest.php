<?php

declare(strict_types=1);

use Talp1\LaravelRegistry\Enums\Jobs;
use Talp1\LaravelRegistry\Models\Job;
use Talp1\LaravelRegistry\Tests\Fakes\Enums\FakeEnum;

it('gets enum class from configs', function (): void {
    config(['registry.enums.jobs' => Jobs::class]);
    $job = new Job;
    expect($job->enum)->toBe(Jobs::class);

    config(['registry.enums.jobs' => FakeEnum::class]);
    $job = new Job;
    expect($job->enum)->toBe(FakeEnum::class);
});

describe('attributes', function (): void {
    it('has id attribute derived from enum value', function (): void {
        $job = Jobs::ACTOR->model();

        expect($job->id)->toBe(Jobs::ACTOR->value);
    });

    it('has label attribute derived from enum label method', function (): void {
        $job = Jobs::ACTOR->model();

        expect($job->label)->toBe(Jobs::ACTOR->label());
    });
});

test('enumCase method returns the corresponding enum case for the model', function (): void {
    $job = Jobs::ACTOR->model();

    expect($job->enumCase())->toBe(Jobs::ACTOR);
});
