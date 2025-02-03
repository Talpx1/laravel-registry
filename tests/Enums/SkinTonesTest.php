<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\SkinTones;

describe('cases structure', function (): void {
    test('case names are uppercase', function (SkinTones $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(SkinTones::cases());

    test('case values are lowercase', function (SkinTones $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(SkinTones::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(SkinTones::toArray())->toBeArray()
            ->toHaveSameSize(SkinTones::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, SkinTones::cases()));

        expect(array_values(SkinTones::toArray()))->toContain(...array_map(fn ($case) => $case->value, SkinTones::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(SkinTones::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(SkinTones::cases())
            ->toEqual(array_map(fn ($case) => $case->value, SkinTones::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(SkinTones::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(SkinTones::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, SkinTones::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(SkinTones::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(SkinTones::cases())
            ->toEqual(array_map(fn ($case) => $case->name, SkinTones::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(SkinTones::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(SkinTones::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, SkinTones::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(SkinTones::random())->toBeInstanceOf(SkinTones::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = SkinTones::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, SkinTones::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = SkinTones::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, SkinTones::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(SkinTones::MEDIUM_4->label())->toBe('Medium 4');
    expect(SkinTones::DARK_8->label())->toBe('Dark 8');
});

test('hexColorCode method returns the hex color code for the case', function (): void {
    expect(SkinTones::MEDIUM_4->hexColorCode())->toBe('#eadaba');
    expect(SkinTones::DARK_8->hexColorCode())->toBe('#604134');
});
