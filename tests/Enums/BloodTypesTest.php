<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\BloodTypes;

describe('cases structure', function (): void {
    test('case names are uppercase', function (BloodTypes $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(BloodTypes::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(BloodTypes::toArray())
            ->toBeArray()
            ->toHaveSameSize(BloodTypes::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, BloodTypes::cases()));

        expect(array_values(BloodTypes::toArray()))->toContain(...array_map(fn ($case) => $case->value, BloodTypes::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(BloodTypes::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(BloodTypes::cases())
            ->toEqual(array_map(fn ($case) => $case->value, BloodTypes::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(BloodTypes::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(BloodTypes::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, BloodTypes::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(BloodTypes::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(BloodTypes::cases())
            ->toEqual(array_map(fn ($case) => $case->name, BloodTypes::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(BloodTypes::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(BloodTypes::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, BloodTypes::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(BloodTypes::random())->toBeInstanceOf(BloodTypes::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = BloodTypes::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, BloodTypes::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = BloodTypes::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, BloodTypes::cases()))->toContain($random);
    });
});

test('label method returns the case value', function (): void {
    expect(BloodTypes::A_POSITIVE->label())->toBe('A+');
    expect(BloodTypes::A_NEGATIVE->label())->toBe('A-');
    expect(BloodTypes::B_POSITIVE->label())->toBe('B+');
    expect(BloodTypes::B_NEGATIVE->label())->toBe('B-');
    expect(BloodTypes::O_POSITIVE->label())->toBe('O+');
    expect(BloodTypes::O_NEGATIVE->label())->toBe('O-');
    expect(BloodTypes::AB_POSITIVE->label())->toBe('AB+');
    expect(BloodTypes::AB_NEGATIVE->label())->toBe('AB-');
});

test('compatibleDonors method returns compatible donor types for the current blood type', function (): void {
    expect(BloodTypes::A_POSITIVE->compatibleDonors())->toBe([BloodTypes::A_POSITIVE, BloodTypes::A_NEGATIVE, BloodTypes::O_POSITIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::A_NEGATIVE->compatibleDonors())->toBe([BloodTypes::A_NEGATIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::B_POSITIVE->compatibleDonors())->toBe([BloodTypes::B_POSITIVE, BloodTypes::B_NEGATIVE, BloodTypes::O_POSITIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::B_NEGATIVE->compatibleDonors())->toBe([BloodTypes::B_NEGATIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::O_POSITIVE->compatibleDonors())->toBe([BloodTypes::O_POSITIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::O_NEGATIVE->compatibleDonors())->toBe([BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::AB_POSITIVE->compatibleDonors())->toBe(BloodTypes::cases());
    expect(BloodTypes::AB_NEGATIVE->compatibleDonors())->toBe([BloodTypes::A_NEGATIVE, BloodTypes::B_NEGATIVE, BloodTypes::O_NEGATIVE, BloodTypes::AB_NEGATIVE]);
});

test('compatibleReceivers method returns compatible receivers types for the current blood type', function (): void {
    expect(BloodTypes::A_POSITIVE->compatibleReceivers())->toBe([BloodTypes::A_POSITIVE, BloodTypes::AB_POSITIVE]);
    expect(BloodTypes::A_NEGATIVE->compatibleReceivers())->toBe([BloodTypes::A_NEGATIVE, BloodTypes::A_POSITIVE, BloodTypes::AB_POSITIVE, BloodTypes::AB_NEGATIVE]);
    expect(BloodTypes::B_POSITIVE->compatibleReceivers())->toBe([BloodTypes::B_POSITIVE, BloodTypes::AB_POSITIVE]);
    expect(BloodTypes::B_NEGATIVE->compatibleReceivers())->toBe([BloodTypes::B_NEGATIVE, BloodTypes::B_POSITIVE, BloodTypes::AB_POSITIVE, BloodTypes::AB_NEGATIVE]);
    expect(BloodTypes::O_POSITIVE->compatibleReceivers())->toBe([BloodTypes::O_POSITIVE, BloodTypes::A_POSITIVE, BloodTypes::B_POSITIVE, BloodTypes::AB_POSITIVE]);
    expect(BloodTypes::O_NEGATIVE->compatibleReceivers())->toBe(BloodTypes::cases());
    expect(BloodTypes::AB_POSITIVE->compatibleReceivers())->toBe([BloodTypes::AB_POSITIVE]);
    expect(BloodTypes::AB_NEGATIVE->compatibleReceivers())->toBe([BloodTypes::AB_POSITIVE, BloodTypes::AB_NEGATIVE]);
});

test('canReceiveFrom method returns true if the current blood type can receive from the given blood type false otherwise', function (): void {
    expect(BloodTypes::A_POSITIVE->canReceiveFrom(BloodTypes::A_POSITIVE))->toBeTrue();
    expect(BloodTypes::AB_POSITIVE->canReceiveFrom(BloodTypes::O_NEGATIVE))->toBeTrue();

    expect(BloodTypes::O_NEGATIVE->canReceiveFrom(BloodTypes::B_POSITIVE))->toBeFalse();
    expect(BloodTypes::B_NEGATIVE->canReceiveFrom(BloodTypes::AB_NEGATIVE))->toBeFalse();
});

test('canDonateTo method returns true if the current blood type can donate to the given blood type false otherwise', function (): void {
    expect(BloodTypes::O_POSITIVE->canDonateTo(BloodTypes::AB_POSITIVE))->toBeTrue();
    expect(BloodTypes::B_POSITIVE->canDonateTo(BloodTypes::B_POSITIVE))->toBeTrue();

    expect(BloodTypes::A_POSITIVE->canDonateTo(BloodTypes::O_NEGATIVE))->toBeFalse();
    expect(BloodTypes::AB_POSITIVE->canDonateTo(BloodTypes::A_POSITIVE))->toBeFalse();
});

test('compatiblePlasmaDonors method returns compatible plasma donor types for the current blood type', function (): void {
    expect(BloodTypes::A_POSITIVE->compatiblePlasmaDonors())->toBe([BloodTypes::A_POSITIVE, BloodTypes::A_NEGATIVE, BloodTypes::AB_POSITIVE, BloodTypes::AB_NEGATIVE]);
    expect(BloodTypes::A_NEGATIVE->compatiblePlasmaDonors())->toBe([BloodTypes::A_POSITIVE, BloodTypes::A_NEGATIVE, BloodTypes::AB_POSITIVE, BloodTypes::AB_NEGATIVE]);
    expect(BloodTypes::B_POSITIVE->compatiblePlasmaDonors())->toBe([BloodTypes::B_POSITIVE, BloodTypes::B_NEGATIVE, BloodTypes::AB_POSITIVE, BloodTypes::AB_NEGATIVE]);
    expect(BloodTypes::B_NEGATIVE->compatiblePlasmaDonors())->toBe([BloodTypes::B_POSITIVE, BloodTypes::B_NEGATIVE, BloodTypes::AB_POSITIVE, BloodTypes::AB_NEGATIVE]);
    expect(BloodTypes::O_POSITIVE->compatiblePlasmaDonors())->toBe(BloodTypes::cases());
    expect(BloodTypes::O_NEGATIVE->compatiblePlasmaDonors())->toBe(BloodTypes::cases());
    expect(BloodTypes::AB_POSITIVE->compatiblePlasmaDonors())->toBe([BloodTypes::AB_NEGATIVE, BloodTypes::AB_NEGATIVE]);
    expect(BloodTypes::AB_NEGATIVE->compatiblePlasmaDonors())->toBe([BloodTypes::AB_NEGATIVE, BloodTypes::AB_NEGATIVE]);
});

test('compatiblePlasmaReceivers method returns compatible plasma receivers types for the current blood type', function (): void {
    expect(BloodTypes::A_POSITIVE->compatiblePlasmaReceivers())->toBe([BloodTypes::A_NEGATIVE, BloodTypes::A_POSITIVE, BloodTypes::O_POSITIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::A_NEGATIVE->compatiblePlasmaReceivers())->toBe([BloodTypes::A_NEGATIVE, BloodTypes::A_POSITIVE, BloodTypes::O_POSITIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::B_POSITIVE->compatiblePlasmaReceivers())->toBe([BloodTypes::B_NEGATIVE, BloodTypes::B_POSITIVE, BloodTypes::O_POSITIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::B_NEGATIVE->compatiblePlasmaReceivers())->toBe([BloodTypes::B_NEGATIVE, BloodTypes::B_POSITIVE, BloodTypes::O_POSITIVE, BloodTypes::O_NEGATIVE]);
    expect(BloodTypes::O_POSITIVE->compatiblePlasmaReceivers())->toBe([BloodTypes::O_NEGATIVE, BloodTypes::O_POSITIVE]);
    expect(BloodTypes::O_NEGATIVE->compatiblePlasmaReceivers())->toBe([BloodTypes::O_NEGATIVE, BloodTypes::O_POSITIVE]);
    expect(BloodTypes::AB_POSITIVE->compatiblePlasmaReceivers())->toBe(BloodTypes::cases());
    expect(BloodTypes::AB_NEGATIVE->compatiblePlasmaReceivers())->toBe(BloodTypes::cases());
});

test('canReceivePlasmaFrom method returns true if the current blood type can receive plasma from the given blood type false otherwise', function (): void {
    expect(BloodTypes::A_POSITIVE->canReceivePlasmaFrom(BloodTypes::A_POSITIVE))->toBeTrue();
    expect(BloodTypes::AB_POSITIVE->canReceivePlasmaFrom(BloodTypes::AB_NEGATIVE))->toBeTrue();
    expect(BloodTypes::O_NEGATIVE->canReceivePlasmaFrom(BloodTypes::B_POSITIVE))->toBeTrue();

    expect(BloodTypes::B_NEGATIVE->canReceivePlasmaFrom(BloodTypes::O_POSITIVE))->toBeFalse();
});

test('canDonatePlasmaTo method returns true if the current blood type can donate plasma to the given blood type false otherwise', function (): void {
    expect(BloodTypes::O_POSITIVE->canDonatePlasmaTo(BloodTypes::O_NEGATIVE))->toBeTrue();
    expect(BloodTypes::B_POSITIVE->canDonatePlasmaTo(BloodTypes::O_POSITIVE))->toBeTrue();
    expect(BloodTypes::AB_POSITIVE->canDonatePlasmaTo(BloodTypes::A_POSITIVE))->toBeTrue();

    expect(BloodTypes::A_POSITIVE->canDonatePlasmaTo(BloodTypes::B_NEGATIVE))->toBeFalse();
});
