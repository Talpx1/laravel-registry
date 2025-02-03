<?php

declare(strict_types=1);
use Illuminate\Support\Collection;
use Talp1\LaravelRegistry\Enums\EducationLevels;

describe('cases structure', function (): void {
    test('case names are uppercase', function (EducationLevels $case): void {
        expect($case->name)->toBeUppercaseAllowingNonWordChars();
    })->with(EducationLevels::cases());

    test('case values are lowercase', function (EducationLevels $case): void {
        expect($case->value)->toBeLowercaseAllowingNonWordChars();
    })->with(EducationLevels::cases());
});

describe('collection methods', function (): void {
    test('toArray method returns an array of cases with name as key and value as value', function (): void {
        expect(EducationLevels::toArray())->toBeArray()
            ->toHaveSameSize(EducationLevels::cases())
            ->toHaveKeys(array_map(fn ($case) => $case->name, EducationLevels::cases()));

        expect(array_values(EducationLevels::toArray()))->toContain(...array_map(fn ($case) => $case->value, EducationLevels::cases()));
    });

    test('valuesToArray method returns an array of cases value', function (): void {
        expect(EducationLevels::valuesToArray())
            ->toBeArray()
            ->toHaveSameSize(EducationLevels::cases())
            ->toEqual(array_map(fn ($case) => $case->value, EducationLevels::cases()));
    });

    test('values method returns a collection of cases value', function (): void {
        expect(EducationLevels::values())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(EducationLevels::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->value, EducationLevels::cases())));
    });

    test('caseNamesToArray method returns an array of cases name', function (): void {
        expect(EducationLevels::caseNamesToArray())
            ->toBeArray()
            ->toHaveSameSize(EducationLevels::cases())
            ->toEqual(array_map(fn ($case) => $case->name, EducationLevels::cases()));
    });

    test('caseNames method returns a collection of cases name', function (): void {
        expect(EducationLevels::caseNames())
            ->toBeInstanceOf(Collection::class)
            ->toHaveSameSize(EducationLevels::cases())
            ->toEqual(collect(array_map(fn ($case) => $case->name, EducationLevels::cases())));
    });
});

describe('random methods', function (): void {
    test('random method returns a random case', function (): void {
        expect(EducationLevels::random())->toBeInstanceOf(EducationLevels::class);
    });

    test('randomValue method returns a random case value', function (): void {
        $random = EducationLevels::randomValue();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->value, EducationLevels::cases()))->toContain($random);
    });

    test('randomCaseName method returns a random case name', function (): void {
        $random = EducationLevels::randomCaseName();
        expect($random)->toBeString();
        expect(array_map(fn ($case) => $case->name, EducationLevels::cases()))->toContain($random);
    });
});

test('label method returns case name with capitalized words', function (): void {
    expect(EducationLevels::PRE_PRIMARY_EDUCATION->label())->toBe('Pre-primary Education');
    expect(EducationLevels::BACHELORS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1->label())->toBe('Bachelor\'s Or Equivalent Level Orientation Unspecified1');
});

describe('isced2011', function (): void {
    test('isced2011Number method returns ISCED 2011 number for the case', function (): void {
        expect(EducationLevels::PRE_PRIMARY_EDUCATION->isced2011Number())->toBe('02');
        expect(EducationLevels::BACHELORS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1->isced2011Number())->toBe('66');
    });

    test('isced2011Category method returns ISCED 2011 category for the case', function (): void {
        expect(EducationLevels::PRE_PRIMARY_EDUCATION->isced2011Category())->toBe('EARLY CHILDHOOD EDUCATION');
        expect(EducationLevels::BACHELORS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1->isced2011Category())->toBe('BACHELOR\'S OR EQUIVALENT LEVEL');
    });

    test('isced2011Description method returns ISCED 2011 description for the case', function (): void {
        expect(EducationLevels::PRE_PRIMARY_EDUCATION->isced2011Description())->toBe('Education designed to support early development in preparation for participation in school and society. Programmes designed for children from age 3 to the start of primary education.');
        expect(EducationLevels::BACHELORS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1->isced2011Description())->toBe('Programmes designed to provide intermediate academic or professional knowledge, skills and competencies leading to a first tertiary degree or equivalent qualification.');
    });
});
