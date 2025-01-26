<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\SocialNetworks;

describe('cases structure', function (): void {
    test('case names are uppercase', function (SocialNetworks $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(SocialNetworks::cases());

    test('case values are lowercase', function (SocialNetworks $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(SocialNetworks::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(SocialNetworks::toArray())
            ->toBeArray()
            ->toHaveSameSize(SocialNetworks::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, SocialNetworks::cases()));

        expect(array_values(SocialNetworks::toArray()))->toContain(...array_map(fn ($case) => $case->value, SocialNetworks::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(SocialNetworks::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(SocialNetworks::cases())
            ->toEqual(array_map(fn ($case) => $case->value, SocialNetworks::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(SocialNetworks::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(SocialNetworks::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, SocialNetworks::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(SocialNetworks::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(SocialNetworks::cases())
            ->toEqual(array_map(fn ($case) => $case->name, SocialNetworks::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(SocialNetworks::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(SocialNetworks::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, SocialNetworks::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(SocialNetworks::random())->toBeInstanceOf(SocialNetworks::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = SocialNetworks::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, SocialNetworks::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = SocialNetworks::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, SocialNetworks::cases()))->toContain($random);
    });
});

test('label method returns custom label or case name with capitalized words', function (): void {
    expect(SocialNetworks::TIKTOK->label())->toBe('TikTok');
    expect(SocialNetworks::QQ->label())->toBe('QQ');
    expect(SocialNetworks::GITHUB->label())->toBe('GitHub');
    expect(SocialNetworks::X->label())->toBe('X');
    expect(SocialNetworks::VIMEO->label())->toBe('Vimeo');
});

test('handlePrefix method returns custom handle prefix or null', function (): void {
    expect(SocialNetworks::X->handlePrefix())->toBe('@');
    expect(SocialNetworks::INSTAGRAM->handlePrefix())->toBe('@');
    expect(SocialNetworks::TIKTOK->handlePrefix())->toBe('@');
    expect(SocialNetworks::GITHUB->handlePrefix())->toBe('@');
    expect(SocialNetworks::GITLAB->handlePrefix())->toBe('@');
    expect(SocialNetworks::DISCORD->handlePrefix())->toBe('@');
    expect(SocialNetworks::SLACK->handlePrefix())->toBe('@');
    expect(SocialNetworks::TELEGRAM->handlePrefix())->toBe('@');
    expect(SocialNetworks::TWITCH->handlePrefix())->toBe('@');
    expect(SocialNetworks::REDDIT->handlePrefix())->toBe('u/');
    expect(SocialNetworks::VIMEO->handlePrefix())->toBeNull();
});
