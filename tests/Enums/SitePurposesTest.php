<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\SitePurposes;

describe('cases structure', function (): void {
    test('case names are uppercase', function (SitePurposes $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(SitePurposes::cases());

    test('case values are lowercase', function (SitePurposes $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(SitePurposes::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(SitePurposes::toArray())->toBeArray()
            ->toHaveSameSize(SitePurposes::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, SitePurposes::cases()));

        expect(array_values(SitePurposes::toArray()))->toContain(...array_map(fn ($case) => $case->value, SitePurposes::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(SitePurposes::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(SitePurposes::cases())
            ->toEqual(array_map(fn ($case) => $case->value, SitePurposes::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(SitePurposes::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(SitePurposes::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, SitePurposes::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(SitePurposes::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(SitePurposes::cases())
            ->toEqual(array_map(fn ($case) => $case->name, SitePurposes::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(SitePurposes::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(SitePurposes::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, SitePurposes::cases())));
    });
});

describe('random methods', function (): void {
    describe('random', function () {
        test('random method returns a random case', function (): void {
            expect(SitePurposes::random())->toBeInstanceOf(SitePurposes::class);
        });

        test('random method with amount greater than 1 returns an array of random cases', function (): void {
            expect(SitePurposes::random(5))
                ->toBeArray()
                ->toHaveCount(5)
                ->toContainOnlyInstancesOf(SitePurposes::class);
        });
    });

    test('randomValue method returns a random case value', function (): void {
        $random = SitePurposes::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, SitePurposes::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = SitePurposes::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, SitePurposes::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(SitePurposes::WAREHOUSE->label())->toBe('Warehouse');
    expect(SitePurposes::DOMICILE->label())->toBe('Domicile');
});
