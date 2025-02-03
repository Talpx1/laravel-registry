<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\EyeColors;

describe('cases structure', function (): void {
    test('case names are uppercase', function (EyeColors $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(EyeColors::cases());

    test('case values are lowercase', function (EyeColors $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(EyeColors::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(EyeColors::toArray())->toBeArray()
            ->toHaveSameSize(EyeColors::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, EyeColors::cases()));

        expect(array_values(EyeColors::toArray()))->toContain(...array_map(fn ($case) => $case->value, EyeColors::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(EyeColors::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(EyeColors::cases())
            ->toEqual(array_map(fn ($case) => $case->value, EyeColors::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(EyeColors::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(EyeColors::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, EyeColors::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(EyeColors::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(EyeColors::cases())
            ->toEqual(array_map(fn ($case) => $case->name, EyeColors::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(EyeColors::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(EyeColors::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, EyeColors::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(EyeColors::random())->toBeInstanceOf(EyeColors::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = EyeColors::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, EyeColors::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = EyeColors::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, EyeColors::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(EyeColors::LIGHT_GRAY_IRIS->label())->toBe('Light-gray Iris');
    expect(EyeColors::MAHOGANY_IRIS->label())->toBe('Mahogany Iris');
});

describe('martinShultzScaleValue', function () {
    test('martinShultzScaleValue method returns the Martin-Shultz scale value for the case', function (): void {
        expect(EyeColors::LIGHT_GRAY_IRIS->martinShultzScaleValue())->toBe('4a');
        expect(EyeColors::MAHOGANY_IRIS->martinShultzScaleValue())->toBe('14');
    });

    test('martinShultzScaleValue method returns null for out-of-scale values', function (): void {
        expect(EyeColors::HETEROCHROMIA->martinShultzScaleValue())->toBeNull();
    });
});

describe('hexColorCode', function () {
    test('hexColorCode method returns the hex color code for the case', function (): void {
        expect(EyeColors::LIGHT_GRAY_IRIS->hexColorCode())->toBe('#BEBEBE');
        expect(EyeColors::MAHOGANY_IRIS->hexColorCode())->toBe('#3B2F2F');
    });

    test('hexColorCode method returns null for mixed eye color values', function (): void {
        expect(EyeColors::HETEROCHROMIA->hexColorCode())->toBeNull();
    });
});
