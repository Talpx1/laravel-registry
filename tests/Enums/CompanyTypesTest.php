<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\CompanyTypes;

describe('cases structure', function (): void {
    test('case names are uppercase', function (CompanyTypes $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(CompanyTypes::cases());

    test('case values are lowercase', function (CompanyTypes $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(CompanyTypes::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(CompanyTypes::toArray())->toBeArray()
            ->toHaveSameSize(CompanyTypes::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, CompanyTypes::cases()));

        expect(array_values(CompanyTypes::toArray()))->toContain(...array_map(fn ($case) => $case->value, CompanyTypes::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(CompanyTypes::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(CompanyTypes::cases())
            ->toEqual(array_map(fn ($case) => $case->value, CompanyTypes::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(CompanyTypes::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(CompanyTypes::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, CompanyTypes::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(CompanyTypes::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(CompanyTypes::cases())
            ->toEqual(array_map(fn ($case) => $case->name, CompanyTypes::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(CompanyTypes::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(CompanyTypes::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, CompanyTypes::cases())));
    });
});

describe('random methods', function (): void {
    describe('random', function () {
        test('random method returns a random case', function (): void {
            expect(CompanyTypes::random())->toBeInstanceOf(CompanyTypes::class);
        });

        test('random method with amount greater than 1 returns an array of random cases', function (): void {
            expect(CompanyTypes::random(5))
                ->toBeArray()
                ->toHaveCount(5)
                ->toContainOnlyInstancesOf(CompanyTypes::class);
        });
    });
    test('randomValue method returns a random case value', function (): void {
        $random = CompanyTypes::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, CompanyTypes::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = CompanyTypes::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, CompanyTypes::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(CompanyTypes::CORPORATE_GROUP->label())->toBe('Corporate Group');
    expect(CompanyTypes::PRIVATE_EQUITY_FIRM->label())->toBe('Private Equity Firm');
});

test('description method returns correct description', function (): void {
    expect(CompanyTypes::CORPORATE_GROUP->description())->toBe('A collection of companies under common ownership or control, often structured with a parent company and subsidiaries.');
    expect(CompanyTypes::PRIVATE_EQUITY_FIRM->description())->toBe('A company that acquires and manages businesses, often restructuring them for higher profitability.');
});
