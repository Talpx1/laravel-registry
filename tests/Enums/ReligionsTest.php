<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\Religions;

describe('cases structure', function (): void {
    test('case names are uppercase', function (Religions $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(Religions::cases());

    test('case values are lowercase', function (Religions $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(Religions::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(Religions::toArray())->toBeArray()
            ->toHaveSameSize(Religions::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, Religions::cases()));

        expect(array_values(Religions::toArray()))->toContain(...array_map(fn ($case) => $case->value, Religions::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(Religions::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(Religions::cases())
            ->toEqual(array_map(fn ($case) => $case->value, Religions::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(Religions::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Religions::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, Religions::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(Religions::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(Religions::cases())
            ->toEqual(array_map(fn ($case) => $case->name, Religions::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(Religions::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Religions::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, Religions::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(Religions::random())->toBeInstanceOf(Religions::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = Religions::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, Religions::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = Religions::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, Religions::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(Religions::TAOISM->label())->toBe('Taoism');
    expect(Religions::YORUBA_RELIGION->label())->toBe('Yoruba Religion');
});
