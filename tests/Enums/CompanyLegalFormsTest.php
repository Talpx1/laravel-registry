<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\CompanyLegalForms;
use Talp1\LaravelRegistry\Enums\Countries;

describe('cases structure', function (): void {
    test('case names are uppercase', function (CompanyLegalForms $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(CompanyLegalForms::random(10));

    test('case values are lowercase', function (CompanyLegalForms $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(CompanyLegalForms::random(10));
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(CompanyLegalForms::toArray())->toBeArray()
            ->toHaveSameSize(CompanyLegalForms::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, CompanyLegalForms::cases()));

        expect(array_values(CompanyLegalForms::toArray()))->toContain(...array_map(fn ($case) => $case->value, CompanyLegalForms::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(CompanyLegalForms::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(CompanyLegalForms::cases())
            ->toEqual(array_map(fn ($case) => $case->value, CompanyLegalForms::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(CompanyLegalForms::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(CompanyLegalForms::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, CompanyLegalForms::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(CompanyLegalForms::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(CompanyLegalForms::cases())
            ->toEqual(array_map(fn ($case) => $case->name, CompanyLegalForms::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(CompanyLegalForms::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(CompanyLegalForms::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, CompanyLegalForms::cases())));
    });
});

describe('random methods', function (): void {
    describe('random', function () {
        test('random method returns a random case', function (): void {
            expect(CompanyLegalForms::random())->toBeInstanceOf(CompanyLegalForms::class);
        });

        test('random method with amount greater than 1 returns an array of random cases', function (): void {
            expect(CompanyLegalForms::random(5))
                ->toBeArray()
                ->toHaveCount(5)
                ->toContainOnlyInstancesOf(CompanyLegalForms::class);
        });
    });

    test('randomValue method returns a random case value', function (): void {
        $random = CompanyLegalForms::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, CompanyLegalForms::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = CompanyLegalForms::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, CompanyLegalForms::cases()))->toContain($random);
    });
});

test('elfCode method returns correct ELF Code for the case', function (): void {
    expect(CompanyLegalForms::VI_FOREIGN_PROFIT_CORPORATION->elfCode())->toBe('UZ9W');
    expect(CompanyLegalForms::AG_INTERNATIONAL_BUSINESS_CORPORATION->elfCode())->toBe('CDOV');
    expect(CompanyLegalForms::IT_SOCIETA_A_RESPONSABILITA_LIMITATA->elfCode())->toBe('OV32');
});

test('countryOfFormation method returns correct instance of Countries enum', function (): void {
    expect(CompanyLegalForms::VI_FOREIGN_PROFIT_CORPORATION->countryOfFormation())->toBe(Countries::UNITED_STATES);
    expect(CompanyLegalForms::AG_INTERNATIONAL_BUSINESS_CORPORATION->countryOfFormation())->toBe(Countries::ANTIGUA_AND_BARBUDA);
    expect(CompanyLegalForms::IT_SOCIETA_A_RESPONSABILITA_LIMITATA->countryOfFormation())->toBe(Countries::ITALY);
});

test('abbreviations method returns array of abbreviations or null', function (): void {
    expect(CompanyLegalForms::VI_FOREIGN_PROFIT_CORPORATION->abbreviations())->toBeNull();
    expect(CompanyLegalForms::AG_INTERNATIONAL_BUSINESS_CORPORATION->abbreviations())->toBeNull();
    expect(CompanyLegalForms::IT_SOCIETA_A_RESPONSABILITA_LIMITATA->abbreviations())->toBe(['SRL', 'S.R.L.']);
});
test('abbreviationsInLocalLanguage method returns array of abbreviations or null', function (): void {
    expect(CompanyLegalForms::JO_SHARIKAT_ALTAWSIA_ALBASITA->abbreviationsInLocalLanguage())->toBe(['توصية بسيطة']);
    expect(CompanyLegalForms::KR_JUSIKHOESA->abbreviationsInLocalLanguage())->toBe(['㈜']);
    expect(CompanyLegalForms::IT_SOCIETA_A_RESPONSABILITA_LIMITATA->abbreviationsInLocalLanguage())->toBe(['SRL', 'S.R.L.']);
    expect(CompanyLegalForms::KW_SHARIKAT_TADAMUN->abbreviationsInLocalLanguage())->toBeNull();
});

test('label method returns correct label', function (): void {
    expect(CompanyLegalForms::VI_FOREIGN_PROFIT_CORPORATION->label())->toBe('Foreign Profit Corporation');
    expect(CompanyLegalForms::AG_INTERNATIONAL_BUSINESS_CORPORATION->label())->toBe('International Business Corporation');
    expect(CompanyLegalForms::IT_SOCIETA_A_RESPONSABILITA_LIMITATA->label())->toBe('Società A Responsabilità Limitata');
});

test('labelInLocalLanguage method returns correct label', function (): void {
    expect(CompanyLegalForms::VI_FOREIGN_PROFIT_CORPORATION->labelInLocalLanguage())->toBe('Foreign Profit Corporation');
    expect(CompanyLegalForms::AG_INTERNATIONAL_BUSINESS_CORPORATION->labelInLocalLanguage())->toBe('International Business Corporation');
    expect(CompanyLegalForms::IT_SOCIETA_A_RESPONSABILITA_LIMITATA->labelInLocalLanguage())->toBe('Società A Responsabilità Limitata');
    expect(CompanyLegalForms::JO_SHARIKAT_ALTAWSIA_ALBASITA->labelInLocalLanguage())->toBe('شركة التوصية البسيطة');
    expect(CompanyLegalForms::KR_JUSIKHOESA->labelInLocalLanguage())->toBe('주식회사');
});
