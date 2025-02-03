<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\MaritalStatuses;

describe('cases structure', function (): void {
    test('case names are uppercase', function (MaritalStatuses $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(MaritalStatuses::cases());

    test('case values are lowercase', function (MaritalStatuses $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(MaritalStatuses::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(MaritalStatuses::toArray())->toBeArray()
            ->toHaveSameSize(MaritalStatuses::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, MaritalStatuses::cases()));

        expect(array_values(MaritalStatuses::toArray()))->toContain(...array_map(fn ($case) => $case->value, MaritalStatuses::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(MaritalStatuses::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(MaritalStatuses::cases())
            ->toEqual(array_map(fn ($case) => $case->value, MaritalStatuses::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(MaritalStatuses::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(MaritalStatuses::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, MaritalStatuses::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(MaritalStatuses::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(MaritalStatuses::cases())
            ->toEqual(array_map(fn ($case) => $case->name, MaritalStatuses::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(MaritalStatuses::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(MaritalStatuses::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, MaritalStatuses::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(MaritalStatuses::random())->toBeInstanceOf(MaritalStatuses::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = MaritalStatuses::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, MaritalStatuses::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = MaritalStatuses::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, MaritalStatuses::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(MaritalStatuses::MARRIED->label())->toBe('Married');
    expect(MaritalStatuses::SINGLE->label())->toBe('Single');
});
