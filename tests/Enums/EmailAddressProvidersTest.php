<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\EmailAddressProviders;

describe('cases structure', function (): void {
    test('case names are uppercase', function (EmailAddressProviders $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(EmailAddressProviders::cases());

    test('case values are lowercase', function (EmailAddressProviders $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(EmailAddressProviders::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(EmailAddressProviders::toArray())
            ->toBeArray()
            ->toHaveSameSize(EmailAddressProviders::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, EmailAddressProviders::cases()));

        expect(array_values(EmailAddressProviders::toArray()))->toContain(...array_map(fn ($case) => $case->value, EmailAddressProviders::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(EmailAddressProviders::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(EmailAddressProviders::cases())
            ->toEqual(array_map(fn ($case) => $case->value, EmailAddressProviders::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(EmailAddressProviders::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(EmailAddressProviders::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, EmailAddressProviders::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(EmailAddressProviders::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(EmailAddressProviders::cases())
            ->toEqual(array_map(fn ($case) => $case->name, EmailAddressProviders::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(EmailAddressProviders::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(EmailAddressProviders::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, EmailAddressProviders::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(EmailAddressProviders::random())->toBeInstanceOf(EmailAddressProviders::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = EmailAddressProviders::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, EmailAddressProviders::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = EmailAddressProviders::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, EmailAddressProviders::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(EmailAddressProviders::GMAIL->label())->toBe('Gmail');
    expect(EmailAddressProviders::FAST_MAIL->label())->toBe('Fast Mail');
});

test('issuesCertifiedAddresses method returns true for providers that issue certified addresses false otherwise', function (): void {
    expect(EmailAddressProviders::INFOCERT->issuesCertifiedAddresses())->toBeTrue();
    expect(EmailAddressProviders::TWT->issuesCertifiedAddresses())->toBeTrue();
    expect(EmailAddressProviders::REGISTER_IT->issuesCertifiedAddresses())->toBeTrue();
    expect(EmailAddressProviders::POSTE_ITALIANE->issuesCertifiedAddresses())->toBeTrue();
    expect(EmailAddressProviders::NAMIRIAL->issuesCertifiedAddresses())->toBeTrue();
    expect(EmailAddressProviders::CEDACRI_CERT->issuesCertifiedAddresses())->toBeTrue();
    expect(EmailAddressProviders::IN_TE_SA->issuesCertifiedAddresses())->toBeTrue();

    expect(EmailAddressProviders::GMAIL->issuesCertifiedAddresses())->toBeFalse();
    expect(EmailAddressProviders::FAST_MAIL->issuesCertifiedAddresses())->toBeFalse();
});

test('availableRootDomains method returns an array of root domains for the provider', function (): void {
    expect(EmailAddressProviders::GMAIL->availableRootDomains())->toBe(['.com']);
    expect(EmailAddressProviders::POSTEO->availableRootDomains())->toBe(['.net', '.us', '.ca']);
});
