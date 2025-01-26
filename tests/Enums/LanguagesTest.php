<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\Languages;

describe('cases structure', function (): void {
    test('case names are uppercase', function (Languages $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(Languages::cases());

    test('case values are lowercase', function (Languages $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(Languages::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(Languages::toArray())->toBeArray()
            ->toHaveSameSize(Languages::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, Languages::cases()));

        expect(array_values(Languages::toArray()))->toContain(...array_map(fn ($case) => $case->value, Languages::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(Languages::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(Languages::cases())
            ->toEqual(array_map(fn ($case) => $case->value, Languages::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(Languages::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Languages::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, Languages::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(Languages::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(Languages::cases())
            ->toEqual(array_map(fn ($case) => $case->name, Languages::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(Languages::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Languages::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, Languages::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(Languages::random())->toBeInstanceOf(Languages::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = Languages::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, Languages::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = Languages::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, Languages::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(Languages::ITALIAN->label())->toBe('Italian');
    expect(Languages::HAITIAN_CREOLE->label())->toBe('Haitian Creole');
});

describe('iso639', function (): void {
    describe('iso6391', function (): void {
        test('iso6391Code method returns ISO 639-1 code for the case', function (): void {
            expect(Languages::ITALIAN->iso6391Code())->toBe('it');
            expect(Languages::HAITIAN_CREOLE->iso6391Code())->toBe('ht');
        });

        test('iso6391Code method returns null if no ISO 639-1 code is available for the case', function (): void {
            expect(Languages::TUVALUAN->iso6391Code())->toBeNull();
        });
    });

    describe('iso6392', function (): void {
        test('iso6392Code method returns ISO 639-2 code for the case', function (): void {
            expect(Languages::ITALIAN->iso6392Code())->toBe('ita');
            expect(Languages::HAITIAN_CREOLE->iso6392Code())->toBe('hat');
        });

        test('iso6392Code method returns null if no ISO 639-2 code is available for the case', function (): void {
            expect(Languages::HAWAIIAN->iso6392Code())->toBeNull();
        });
    });

    describe('iso6393', function (): void {
        test('iso6393Code method returns ISO 639-3 code for the case', function (): void {
            expect(Languages::ITALIAN->iso6393Code())->toBe('ita');
            expect(Languages::HAITIAN_CREOLE->iso6393Code())->toBe('hat');
        });

        test('iso6393Code method returns null if no ISO 639-3 code is available for the case', function (): void {
            expect(Languages::HAWAIIAN->iso6393Code())->toBeNull();
        });
    });
});
