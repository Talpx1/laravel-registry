<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\EconomicSectors;

describe('cases structure', function (): void {
    test('case names are uppercase', function (EconomicSectors $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(EconomicSectors::cases());

    test('case values are lowercase', function (EconomicSectors $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(EconomicSectors::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(EconomicSectors::toArray())->toBeArray()
            ->toHaveSameSize(EconomicSectors::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, EconomicSectors::cases()));

        expect(array_values(EconomicSectors::toArray()))->toContain(...array_map(fn ($case) => $case->value, EconomicSectors::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(EconomicSectors::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(EconomicSectors::cases())
            ->toEqual(array_map(fn ($case) => $case->value, EconomicSectors::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(EconomicSectors::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(EconomicSectors::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, EconomicSectors::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(EconomicSectors::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(EconomicSectors::cases())
            ->toEqual(array_map(fn ($case) => $case->name, EconomicSectors::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(EconomicSectors::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(EconomicSectors::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, EconomicSectors::cases())));
    });
});

describe('random methods', function (): void {
    describe('random', function () {
        test('random method returns a random case', function (): void {
            expect(EconomicSectors::random())->toBeInstanceOf(EconomicSectors::class);
        });

        test('random method with amount greater than 1 returns an array of random cases', function (): void {
            expect(EconomicSectors::random(2))
                ->toBeArray()
                ->toHaveCount(2)
                ->toContainOnlyInstancesOf(EconomicSectors::class);
        });
    });
    test('randomValue method returns a random case value', function (): void {
        $random = EconomicSectors::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, EconomicSectors::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = EconomicSectors::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, EconomicSectors::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(EconomicSectors::PRIMARY->label())->toBe('Primary');
    expect(EconomicSectors::SECONDARY->label())->toBe('Secondary');
    expect(EconomicSectors::TERTIARY->label())->toBe('Tertiary');
});

test('description method returns correct description', function (): void {
    expect(EconomicSectors::PRIMARY->description())->toBe('Involves the retrieval and production of raw-material products, such as corn, coal, wood or iron. Miners, farmers and fishermen are all workers in the primary sector.');
    expect(EconomicSectors::SECONDARY->description())->toBe('Involves the transformation of raw or intermediate materials into goods, as in steel into cars, or textiles into clothing. Builders and dressmakers work in the secondary sector.');
    expect(EconomicSectors::TERTIARY->description())->toBe('Involves the supplying of services to consumers and businesses, such as babysitting, cinemas or banking. Shopkeepers and accountants work in the tertiary sector.');
});
