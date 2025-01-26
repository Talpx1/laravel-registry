<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\CurrencyFractionalUnits;

describe('cases structure', function (): void {
    test('case names are uppercase', function (CurrencyFractionalUnits $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(CurrencyFractionalUnits::cases());

    test('case values are lowercase', function (CurrencyFractionalUnits $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(CurrencyFractionalUnits::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(CurrencyFractionalUnits::toArray())->toBeArray()
            ->toHaveSameSize(CurrencyFractionalUnits::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, CurrencyFractionalUnits::cases()));

        expect(array_values(CurrencyFractionalUnits::toArray()))->toContain(...array_map(fn ($case) => $case->value, CurrencyFractionalUnits::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(CurrencyFractionalUnits::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(CurrencyFractionalUnits::cases())
            ->toEqual(array_map(fn ($case) => $case->value, CurrencyFractionalUnits::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(CurrencyFractionalUnits::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(CurrencyFractionalUnits::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, CurrencyFractionalUnits::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(CurrencyFractionalUnits::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(CurrencyFractionalUnits::cases())
            ->toEqual(array_map(fn ($case) => $case->name, CurrencyFractionalUnits::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(CurrencyFractionalUnits::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(CurrencyFractionalUnits::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, CurrencyFractionalUnits::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(CurrencyFractionalUnits::random())->toBeInstanceOf(CurrencyFractionalUnits::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = CurrencyFractionalUnits::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, CurrencyFractionalUnits::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = CurrencyFractionalUnits::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, CurrencyFractionalUnits::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(CurrencyFractionalUnits::CENT->label())->toBe('Cent');
    expect(CurrencyFractionalUnits::BOLIVAR->label())->toBe('Bolivar');
});

describe('alternativeNames', function (): void {
    test('alternativeNames method returns an array of alternative names for the case', function (): void {
        expect(CurrencyFractionalUnits::CENT->alternativeNames())->toBe(['centimo', 'centesimo', 'centavo', 'sen', 'tene', 'sent', 'centime', 'santim', 'sente', 'centas', 'sentimo', 'santims', 'sente', 'centimo']);
    });

    test('alternativeNames method returns null for cases without alternative names', function (): void {
        expect(CurrencyFractionalUnits::BOLIVAR->alternativeNames())->toBeNull();
    });
});
