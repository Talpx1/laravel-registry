<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\Currencies;
use Talp1\LaravelRegistry\Enums\CurrencyFractionalUnits;

describe('cases structure', function (): void {
    test('case names are uppercase', function (Currencies $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(Currencies::cases());

    test('case values are lowercase', function (Currencies $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(Currencies::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(Currencies::toArray())->toBeArray()
            ->toHaveSameSize(Currencies::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, Currencies::cases()));

        expect(array_values(Currencies::toArray()))->toContain(...array_map(fn ($case) => $case->value, Currencies::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(Currencies::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(Currencies::cases())
            ->toEqual(array_map(fn ($case) => $case->value, Currencies::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(Currencies::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Currencies::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, Currencies::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(Currencies::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(Currencies::cases())
            ->toEqual(array_map(fn ($case) => $case->name, Currencies::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(Currencies::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(Currencies::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, Currencies::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(Currencies::random())->toBeInstanceOf(Currencies::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = Currencies::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, Currencies::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = Currencies::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, Currencies::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(Currencies::EURO->label())->toBe('Euro');
    expect(Currencies::NIGERIAN_NAIRA->label())->toBe('Nigerian Naira');
});

test('symbolOrAbbreviation method returns currency symbol or abbreviation for the case', function (): void {
    expect(Currencies::EURO->symbolOrAbbreviation())->toBe('€');
    expect(Currencies::NIGERIAN_NAIRA->symbolOrAbbreviation())->toBe('₦');
});

describe('iso4217', function (): void {
    describe('iso4217Code', function (): void {
        test('iso4217Code method returns ISO 4217 code for the case', function (): void {
            expect(Currencies::EURO->iso4217Code())->toBe('EUR');
            expect(Currencies::NIGERIAN_NAIRA->iso4217Code())->toBe('NGN');
        });

        test('iso4217Code method returns null if no ISO 4217 code is available for the case', function (): void {
            expect(Currencies::BELGIAN_FRANC->iso4217Code())->toBeNull();
        });
    });

    describe('iso4217Number', function (): void {
        test('iso4217Number method returns ISO 4217 number for the case', function (): void {
            expect(Currencies::EURO->iso4217Number())->toBe('978');
            expect(Currencies::NIGERIAN_NAIRA->iso4217Number())->toBe('566');
        });

        test('iso4217Number method returns null if no ISO 4217 number is available for the case', function (): void {
            expect(Currencies::BELGIAN_FRANC->iso4217Number())->toBeNull();
        });
    });

    describe('iso4217DecimalDigits', function (): void {
        test('iso4217DecimalDigits method returns ISO 4217 decimal digits amount for the case', function (): void {
            expect(Currencies::EURO->iso4217DecimalDigits())->toBe(2);
            expect(Currencies::RWANDAN_FRANC->iso4217DecimalDigits())->toBe(0);
        });

        test('iso4217DecimalDigits method returns null if no ISO 4217 decimal digits amount is available for the case', function (): void {
            expect(Currencies::BELGIAN_FRANC->iso4217DecimalDigits())->toBeNull();
        });
    });
});

describe('anchorCurrency', function (): void {
    test('anchorCurrency method returns the anchor currency for the case as instance of Currencies enum', function (): void {
        expect(Currencies::EAST_CARIBBEAN_DOLLAR->anchorCurrency())->toBe(Currencies::US_DOLLAR);
        expect(Currencies::CABO_VERDE_ESCUDO->anchorCurrency())->toBe(Currencies::EURO);
    });

    test('anchorCurrency method returns null if no anchor currency is available for the case', function (): void {
        expect(Currencies::US_DOLLAR->anchorCurrency())->toBeNull();
        expect(Currencies::EURO->anchorCurrency())->toBeNull();
    });
});

test('hasAnchorCurrency method returns true for cases that have an anchor currency and false for cases that do not have an anchor currency', function (): void {
    expect(Currencies::EAST_CARIBBEAN_DOLLAR->hasAnchorCurrency())->toBeTrue();
    expect(Currencies::CABO_VERDE_ESCUDO->hasAnchorCurrency())->toBeTrue();

    expect(Currencies::US_DOLLAR->hasAnchorCurrency())->toBeFalse();
    expect(Currencies::EURO->hasAnchorCurrency())->toBeFalse();
});

describe('fractionalUnit', function (): void {
    test('fractionalUnit method returns the fractional unit for the case as instance of CurrencyFractionalUnits enum', function (): void {
        expect(Currencies::EURO->fractionalUnit())->toBe(CurrencyFractionalUnits::CENT);
        expect(Currencies::NIGERIAN_NAIRA->fractionalUnit())->toBe(CurrencyFractionalUnits::KOBO);
    });

    test('fractionalUnit method returns null if no fractional unit is available for the case', function (): void {
        expect(Currencies::BELGIAN_FRANC->fractionalUnit())->toBeNull();
    });
});

describe('fractionsPerUnit', function (): void {
    test('fractionsPerUnit method returns he amount of fractional units needed to reach the value of a unit for the case', function (): void {
        expect(Currencies::EURO->fractionsPerUnit())->toBe(100);
        expect(Currencies::OMANI_RIAL->fractionsPerUnit())->toBe(1000);
    });

    test('fractionsPerUnit method returns null if no data is available for the case', function (): void {
        expect(Currencies::BELGIAN_FRANC->fractionsPerUnit())->toBeNull();
    });
});
