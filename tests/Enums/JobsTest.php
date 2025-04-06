<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\Jobs;

describe('cases structure', function (): void {
    test('case names are uppercase', function (Jobs $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(Jobs::cases());

    test('case values are lowercase', function (Jobs $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(Jobs::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(Jobs::toArray())->toBeArray()
            ->toHaveSameSize(Jobs::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, Jobs::cases()));

        expect(array_values(Jobs::toArray()))->toContain(...array_map(fn ($case) => $case->value, Jobs::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(Jobs::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(Jobs::cases())
            ->toEqual(array_map(fn ($case) => $case->value, Jobs::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(Jobs::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Jobs::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, Jobs::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(Jobs::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(Jobs::cases())
            ->toEqual(array_map(fn ($case) => $case->name, Jobs::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(Jobs::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Jobs::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, Jobs::cases())));
    });
});

describe('random methods', function (): void {
    describe('random', function () {
        test('random method returns a random case', function (): void {
            expect(Jobs::random())->toBeInstanceOf(Jobs::class);
        });

        test('random method with amount greater than 1 returns an array of random cases', function (): void {
            expect(Jobs::random(5))
                ->toBeArray()
                ->toHaveCount(5)
                ->toContainOnlyInstancesOf(Jobs::class);
        });
    });

    test('randomValue method returns a random case value', function (): void {
        $random = Jobs::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, Jobs::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = Jobs::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, Jobs::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(Jobs::ARCHITECT->label())->toBe('Architect');
    expect(Jobs::SINGER->label())->toBe('Singer');
});
