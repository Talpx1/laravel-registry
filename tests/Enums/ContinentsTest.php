<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\Continents;

describe('cases structure', function (): void {
    test('case names are uppercase', function (Continents $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(Continents::cases());

    test('case values are lowercase', function (Continents $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(Continents::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(Continents::toArray())
            ->toBeArray()
            ->toHaveSameSize(Continents::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, Continents::cases()));

        expect(array_values(Continents::toArray()))->toContain(...array_map(fn ($case) => $case->value, Continents::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(Continents::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(Continents::cases())
            ->toEqual(array_map(fn ($case) => $case->value, Continents::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(Continents::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Continents::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, Continents::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(Continents::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(Continents::cases())
            ->toEqual(array_map(fn ($case) => $case->name, Continents::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(Continents::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Continents::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, Continents::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(Continents::random())->toBeInstanceOf(Continents::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = Continents::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, Continents::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = Continents::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, Continents::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(Continents::AFRICA->label())->toBe('Africa');
    expect(Continents::NORTH_AMERICA->label())->toBe('North America');
});
