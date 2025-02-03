<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\Genders;

describe('cases structure', function (): void {
    test('case names are uppercase', function (Genders $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(Genders::cases());

    test('case values are lowercase', function (Genders $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(Genders::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(Genders::toArray())->toBeArray()
            ->toHaveSameSize(Genders::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, Genders::cases()));

        expect(array_values(Genders::toArray()))->toContain(...array_map(fn ($case) => $case->value, Genders::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(Genders::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(Genders::cases())
            ->toEqual(array_map(fn ($case) => $case->value, Genders::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(Genders::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Genders::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, Genders::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(Genders::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(Genders::cases())
            ->toEqual(array_map(fn ($case) => $case->name, Genders::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(Genders::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Genders::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, Genders::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(Genders::random())->toBeInstanceOf(Genders::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = Genders::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, Genders::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = Genders::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, Genders::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(Genders::MALE->label())->toBe('Male');
    expect(Genders::FEMALE->label())->toBe('Female');
});
