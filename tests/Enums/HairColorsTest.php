<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\HairColors;

describe('cases structure', function (): void {
    test('case names are uppercase', function (HairColors $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(HairColors::cases());

    test('case values are lowercase', function (HairColors $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(HairColors::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(HairColors::toArray())->toBeArray()
            ->toHaveSameSize(HairColors::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, HairColors::cases()));

        expect(array_values(HairColors::toArray()))->toContain(...array_map(fn ($case) => $case->value, HairColors::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(HairColors::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(HairColors::cases())
            ->toEqual(array_map(fn ($case) => $case->value, HairColors::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(HairColors::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(HairColors::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, HairColors::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(HairColors::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(HairColors::cases())
            ->toEqual(array_map(fn ($case) => $case->name, HairColors::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(HairColors::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(HairColors::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, HairColors::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(HairColors::random())->toBeInstanceOf(HairColors::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = HairColors::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, HairColors::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = HairColors::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, HairColors::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(HairColors::BLOND->label())->toBe('Blond');
    expect(HairColors::RED_BLOND->label())->toBe('Red Blond');
});

describe('fischerSallerScaleRange', function () {
    test('fischerSallerScaleRange method returns the Martin-Shultz scale value for the case', function (): void {
        expect(HairColors::BLOND->fischerSallerScaleRange())->toBe('F-L');
        expect(HairColors::RED_BLOND->fischerSallerScaleRange())->toBe('V-VI');
    });

    test('fischerSallerScaleRange method returns null for out-of-scale values', function (): void {
        expect(HairColors::DYED->fischerSallerScaleRange())->toBeNull();
    });
});
