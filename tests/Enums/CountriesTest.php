<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\Continents;
use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Enums\Currencies;
use Talp1\LaravelRegistry\Enums\Languages;

describe('cases structure', function (): void {
    test('case names are uppercase', function (Countries $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(Countries::cases());

    test('case values are lowercase', function (Countries $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(Countries::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(Countries::toArray())->toBeArray()
            ->toHaveSameSize(Countries::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, Countries::cases()));

        expect(array_values(Countries::toArray()))->toContain(...array_map(fn ($case) => $case->value, Countries::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(Countries::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(Countries::cases())
            ->toEqual(array_map(fn ($case) => $case->value, Countries::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(Countries::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Countries::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, Countries::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(Countries::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(Countries::cases())
            ->toEqual(array_map(fn ($case) => $case->name, Countries::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(Countries::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Countries::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, Countries::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(Countries::random())->toBeInstanceOf(Countries::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = Countries::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, Countries::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = Countries::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, Countries::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(Countries::ITALY->label())->toBe('Italy');
    expect(Countries::ANTIGUA_AND_BARBUDA->label())->toBe('Antigua And Barbuda');
});

describe('iso3166', function (): void {
    test('iso3166Alpha2Code method returns ISO 3166-1 alpha-2 code for the case', function (): void {
        expect(Countries::ITALY->iso3166Alpha2Code())->toBe('IT');
        expect(Countries::ANTIGUA_AND_BARBUDA->iso3166Alpha2Code())->toBe('AG');
    });

    test('iso3166Alpha3Code method returns ISO 3166-1 alpha-3 code for the case', function (): void {
        expect(Countries::ITALY->iso3166Alpha3Code())->toBe('ITA');
        expect(Countries::ANTIGUA_AND_BARBUDA->iso3166Alpha3Code())->toBe('ATG');
    });

    test('iso3166NumericCode method returns ISO 3166-1 numeric code for the case', function (): void {
        expect(Countries::ITALY->iso3166NumericCode())->toBe('380');
        expect(Countries::ANTIGUA_AND_BARBUDA->iso3166NumericCode())->toBe('028');
    });
});

test('phonePrefix method returns phone prefix for the case', function (): void {
    expect(Countries::ITALY->phonePrefix())->toBe('39');
    expect(Countries::ANTIGUA_AND_BARBUDA->phonePrefix())->toBe('1-268');
});

test('allPhonePrefixes method returns all phone prefixes of all the countries', function (): void {
    expect(Countries::allPhonePrefixes())
        ->toBeArray()
        ->toHaveSameSize(Countries::cases());
});

test('officialLanguages method returns an array of official languages for the case as instances of Languages enum', function (Countries $case): void {
    expect($case->officialLanguages())
        ->toBeArray()
        ->toContainOnlyInstancesOf(Languages::class);
})->with(Countries::cases());

test('continent method returns the continent of the country as an instance of Continents enum', function (Countries $case): void {
    expect($case->continent())->toBeInstanceOf(Continents::class);
})->with(Countries::cases());

test('officialCurrencies method returns an array of official currencies for the case as instances of Currencies enum', function (Countries $case): void {
    expect($case->officialCurrencies())
        ->toBeArray()
        ->toContainOnlyInstancesOf(Currencies::class);
})->with(Countries::cases());
