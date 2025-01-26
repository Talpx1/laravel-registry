<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\PhoneLineTypes;

describe('cases structure', function (): void {
    test('case names are uppercase', function (PhoneLineTypes $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(PhoneLineTypes::cases());

    test('case values are lowercase', function (PhoneLineTypes $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(PhoneLineTypes::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(PhoneLineTypes::toArray())
            ->toBeArray()
            ->toHaveSameSize(PhoneLineTypes::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, PhoneLineTypes::cases()));

        expect(array_values(PhoneLineTypes::toArray()))->toContain(...array_map(fn ($case) => $case->value, PhoneLineTypes::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(PhoneLineTypes::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(PhoneLineTypes::cases())
            ->toEqual(array_map(fn ($case) => $case->value, PhoneLineTypes::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(PhoneLineTypes::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(PhoneLineTypes::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, PhoneLineTypes::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(PhoneLineTypes::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(PhoneLineTypes::cases())
            ->toEqual(array_map(fn ($case) => $case->name, PhoneLineTypes::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(PhoneLineTypes::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(PhoneLineTypes::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, PhoneLineTypes::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(PhoneLineTypes::random())->toBeInstanceOf(PhoneLineTypes::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = PhoneLineTypes::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, PhoneLineTypes::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = PhoneLineTypes::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, PhoneLineTypes::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(PhoneLineTypes::FIXED->label())->toBe('Fixed');
    expect(PhoneLineTypes::MOBILE->label())->toBe('Mobile');
});
