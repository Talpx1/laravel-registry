<?php

declare(strict_types=1);

use Talp1\LaravelRegistry\Enums\BloodTypes;
use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Enums\EducationLevels;
use Talp1\LaravelRegistry\Enums\EyeColors;
use Talp1\LaravelRegistry\Enums\Genders;
use Talp1\LaravelRegistry\Enums\HairColors;
use Talp1\LaravelRegistry\Enums\MaritalStatuses;
use Talp1\LaravelRegistry\Enums\Religions;
use Talp1\LaravelRegistry\Enums\SkinTones;
use Talp1\LaravelRegistry\Models\Address;
use Talp1\LaravelRegistry\Models\EmailAddress;
use Talp1\LaravelRegistry\Models\Person;
use Talp1\LaravelRegistry\Models\PhoneNumber;
use Talp1\LaravelRegistry\Models\SocialNetworkProfile;
use Talp1\LaravelRegistry\Models\Website;
use Talp1\LaravelRegistry\Tests\Fakes\Enums\FakeEnum;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function (): void {
    test('table name is read from config', function (): void {
        config(['registry.database.table_names.people' => 'people']);
        recreateAllTables();
        assertDatabaseHasTable('people');

        config(['registry.database.table_names.people' => 'test_people']);
        recreateAllTables();
        assertDatabaseHasTable('test_people');
        assertDatabaseMissingTable('people');
    });

    test('expected columns are created', function (): void {
        assertTableHasColumns(Person::class,
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'date_of_birth',
            'birth_city',
            'birth_country',
            'height_in_cm',
            'weight_in_kg',
            'education_level',
            'eyes_color',
            'hair_color',
            'skin_tone',
            'blood_type',
            'marital_status',
            'religion',
            'notes',
            'created_at',
            'updated_at',
        );
    });

    test('required columns', function (string $column): void {
        assertColumnIsRequired(Person::class, $column);
    })->with(['id', 'first_name', 'last_name']);

    test('nullable columns', function (string $column): void {
        assertColumnIsNullable(Person::class, $column);
    })->with([
        'middle_name',
        'gender',
        'date_of_birth',
        'birth_city',
        'birth_country',
        'height_in_cm',
        'weight_in_kg',
        'education_level',
        'eyes_color',
        'hair_color',
        'skin_tone',
        'blood_type',
        'marital_status',
        'religion',
        'notes',
        'created_at',
        'updated_at',
    ]);
});

describe('read and write db', function (): void {
    it('can create a person', function (): void {
        $person = Person::factory()->create();

        assertDatabaseHas(Person::class, [
            'id' => $person->id,
        ]);
    });

    it('can update a person', function (): void {
        $person = Person::factory()->create();
        $person->update(['first_name' => 'Test']);

        assertDatabaseHas(Person::class, [
            'id' => $person->id,
            'first_name' => 'Test',
        ]);
    });

    it('can delete a person', function (): void {
        $person = Person::factory()->create();
        $person_id = $person->id;
        $person->delete();

        assertDatabaseMissing(Person::class, [
            'id' => $person_id,
        ]);
    });

    it('can retrieve a person', function (): void {
        $person = Person::factory()->create();

        $foundPerson = Person::find($person->id);

        expect($foundPerson)->not->toBeNull();
        expect($foundPerson->id)->toBe($person->id);
    });

    it('can list all people', function (): void {
        Person::factory()->count(5)->create();

        $person = Person::all();

        expect($person)->toHaveCount(5);
    });
});

describe('constructor', function (): void {
    it('adds primary key to guarded', function (): void {
        $person = new Person;

        $expected_guarded = [
            'created_at',
            'updated_at',
            $person->getKeyName(),
        ];

        expect($person->getGuarded())->toBe($expected_guarded);
    });

    describe('table name', function (): void {
        it('binds model table from config', function (): void {
            config([
                'registry.database.table_names.people' => 'test',
            ]);

            expect(getTableNameForModel(Person::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function (): void {
            config([
                'registry.database.table_names.people' => null,
            ]);

            expect(getTableNameForModel(Person::class))->toBe('people');
        });
    });
});

describe('casts', function (): void {
    it('casts gender attribute as enum specified in config', function (): void {
        config(['registry.enums.genders' => Genders::class]);
        $person = Person::factory()->create(['gender' => Genders::MALE]);
        expect($person->gender)->toBe(Genders::MALE);

        config(['registry.enums.genders' => FakeEnum::class]);
        $person = Person::factory()->create(['gender' => FakeEnum::FAKE]);
        expect($person->gender)->toBe(FakeEnum::FAKE);
    });

    it('casts birth_country attribute as enum specified in config', function (): void {
        config(['registry.enums.countries' => Countries::class]);
        $person = Person::factory()->create(['birth_country' => Countries::ITALY]);
        expect($person->birth_country)->toBe(Countries::ITALY);

        config(['registry.enums.countries' => FakeEnum::class]);
        $person = Person::factory()->create(['birth_country' => FakeEnum::FAKE]);
        expect($person->birth_country)->toBe(FakeEnum::FAKE);
    });

    it('casts education_level attribute as enum specified in config', function (): void {
        config(['registry.enums.education_levels' => EducationLevels::class]);
        $person = Person::factory()->create(['education_level' => EducationLevels::BACHELORS_OR_EQUIVALENT_LEVEL_ACADEMIC]);
        expect($person->education_level)->toBe(EducationLevels::BACHELORS_OR_EQUIVALENT_LEVEL_ACADEMIC);

        config(['registry.enums.education_levels' => FakeEnum::class]);
        $person = Person::factory()->create(['education_level' => FakeEnum::FAKE]);
        expect($person->education_level)->toBe(FakeEnum::FAKE);
    });

    it('casts eyes_color attribute as enum specified in config', function (): void {
        config(['registry.enums.eye_colors' => EyeColors::class]);
        $person = Person::factory()->create(['eyes_color' => EyeColors::LIGHT_GRAY_IRIS]);
        expect($person->eyes_color)->toBe(EyeColors::LIGHT_GRAY_IRIS);

        config(['registry.enums.eye_colors' => FakeEnum::class]);
        $person = Person::factory()->create(['eyes_color' => FakeEnum::FAKE]);
        expect($person->eyes_color)->toBe(FakeEnum::FAKE);
    });

    it('casts hair_color attribute as enum specified in config', function (): void {
        config(['registry.enums.hair_colors' => HairColors::class]);
        $person = Person::factory()->create(['hair_color' => HairColors::DARK_BLOND]);
        expect($person->hair_color)->toBe(HairColors::DARK_BLOND);

        config(['registry.enums.hair_colors' => FakeEnum::class]);
        $person = Person::factory()->create(['hair_color' => FakeEnum::FAKE]);
        expect($person->hair_color)->toBe(FakeEnum::FAKE);
    });

    it('casts skin_tone attribute as enum specified in config', function (): void {
        config(['registry.enums.skin_tones' => SkinTones::class]);
        $person = Person::factory()->create(['skin_tone' => SkinTones::LIGHT_2]);
        expect($person->skin_tone)->toBe(SkinTones::LIGHT_2);

        config(['registry.enums.skin_tones' => FakeEnum::class]);
        $person = Person::factory()->create(['skin_tone' => FakeEnum::FAKE]);
        expect($person->skin_tone)->toBe(FakeEnum::FAKE);
    });

    it('casts blood_type attribute as enum specified in config', function (): void {
        config(['registry.enums.blood_types' => BloodTypes::class]);
        $person = Person::factory()->create(['blood_type' => BloodTypes::A_NEGATIVE]);
        expect($person->blood_type)->toBe(BloodTypes::A_NEGATIVE);

        config(['registry.enums.blood_types' => FakeEnum::class]);
        $person = Person::factory()->create(['blood_type' => FakeEnum::FAKE]);
        expect($person->blood_type)->toBe(FakeEnum::FAKE);
    });

    it('casts marital_status attribute as enum specified in config', function (): void {
        config(['registry.enums.marital_statuses' => MaritalStatuses::class]);
        $person = Person::factory()->create(['marital_status' => MaritalStatuses::SINGLE]);
        expect($person->marital_status)->toBe(MaritalStatuses::SINGLE);

        config(['registry.enums.marital_statuses' => FakeEnum::class]);
        $person = Person::factory()->create(['marital_status' => FakeEnum::FAKE]);
        expect($person->marital_status)->toBe(FakeEnum::FAKE);
    });

    it('casts religion attribute as enum specified in config', function (): void {
        config(['registry.enums.religions' => Religions::class]);
        $person = Person::factory()->create(['religion' => Religions::CHEONDOISM]);
        expect($person->religion)->toBe(Religions::CHEONDOISM);

        config(['registry.enums.religions' => FakeEnum::class]);
        $person = Person::factory()->create(['religion' => FakeEnum::FAKE]);
        expect($person->religion)->toBe(FakeEnum::FAKE);
    });

    it('casts date_of_birth as date', function (): void {
        $person = Person::factory()->create(['date_of_birth' => '2001-01-01']);
        expect($person->date_of_birth)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
        expect($person->date_of_birth->format('Y-m-d'))->toBe('2001-01-01');
    });
});

describe('accessors and mutators', function (): void {
    describe('full name', function (): void {
        it('joins first_name middle_name last_name with a space', function (): void {
            $person = Person::factory()->create([
                'first_name' => 'First',
                'middle_name' => 'Middle',
                'last_name' => 'Last',
            ]);
            expect($person->full_name)->toBe('First Middle Last');
        });

        it('capitalizes each part', function (): void {
            $person = Person::factory()->create([
                'first_name' => 'first',
                'middle_name' => 'middle',
                'last_name' => 'last',
            ]);

            expect($person->full_name)->toBe('First Middle Last');
        });

        it('discard nulls before joining', function (): void {
            $person = Person::factory()->create([
                'first_name' => 'First',
                'middle_name' => null,
                'last_name' => 'Last',
            ]);

            expect($person->full_name)->toBe('First Last');
        });
    });

    describe('age', function (): void {
        test('age accessor returns persons age from date of birth', function (): void {
            $person = Person::factory()->create(['date_of_birth' => now()->subYears(23)->format('Y-m-d')]);

            expect($person->age)->toBe(23);
        });

        test('age accessor returns null if persons date of birth is null', function (): void {
            $person = Person::factory()->create(['date_of_birth' => null]);

            expect($person->age)->toBeNull();
        });
    });

    describe('birth_week_day', function (): void {
        test('birth_week_day accessor returns the name of the day of the week of a person birthday', function (): void {
            $person = Person::factory()->create(['date_of_birth' => '2001-01-01']);

            expect($person->birth_week_day)->toBe('Monday');
        });

        test('birth_week_day accessor returns null if persons date of birth is null', function (): void {
            $person = Person::factory()->create(['date_of_birth' => null]);

            expect($person->birth_week_day)->toBeNull();
        });
    });

    describe('height_in_meters', function (): void {
        test('height_in_meters accessor converts persons height in cm to meters', function (): void {
            $person = Person::factory()->create(['height_in_cm' => 173]);

            expect($person->height_in_meters)->toBe(1.73);
        });

        test('height_in_meters accessor returns null if persons height_in_cm is null', function (): void {
            $person = Person::factory()->create(['height_in_cm' => null]);

            expect($person->height_in_meters)->toBeNull();
        });
    });

    describe('height_in_inches', function (): void {
        test('height_in_inches accessor converts persons height in cm to inches', function (): void {
            $person = Person::factory()->create(['height_in_cm' => 173]);

            expect($person->height_in_inches)->toBe(68.11);
        });

        test('height_in_inches accessor returns null if persons height_in_cm is null', function (): void {
            $person = Person::factory()->create(['height_in_cm' => null]);

            expect($person->height_in_inches)->toBeNull();
        });
    });

    describe('height_in_feet', function (): void {
        test('height_in_feet accessor converts persons height in cm to feet', function (): void {
            $person = Person::factory()->create(['height_in_cm' => 173]);

            expect($person->height_in_feet)->toBe(5.68);
        });

        test('height_in_feet accessor returns null if persons height_in_cm is null', function (): void {
            $person = Person::factory()->create(['height_in_cm' => null]);

            expect($person->height_in_feet)->toBeNull();
        });
    });

    describe('height_in_feet_human_readable', function (): void {
        test('height_in_feet_human_readable accessor converts persons height in cm to feet and inches', function (): void {
            $person = Person::factory()->create(['height_in_cm' => 173]);

            expect($person->height_in_feet_human_readable)->toBe('5\' 8"');
        });

        test('height_in_feet_human_readable accessor returns null if persons height_in_cm is null', function (): void {
            $person = Person::factory()->create(['height_in_cm' => null]);

            expect($person->height_in_feet_human_readable)->toBeNull();
        });
    });

    describe('weight_in_pounds', function (): void {
        test('weight_in_pounds accessor converts persons weight_in_kg to pounds', function (): void {
            $person = Person::factory()->create(['weight_in_kg' => 70]);

            expect($person->weight_in_pounds)->toBe(154.32);
        });

        test('weight_in_pounds accessor returns null if persons weight_in_kg is null', function (): void {
            $person = Person::factory()->create(['weight_in_kg' => null]);

            expect($person->weight_in_pounds)->toBeNull();
        });
    });
});

describe('relations', function (): void {
    it('morph many addresses', function (): void {
        $person = Person::factory()->create();
        $addresses = Address::factory()->count(5)->for($person, 'owner')->create();

        expect($person->addresses)->toContainOnlyInstancesOf(Address::class);
        expect($person->addresses)->toHaveCount(5);
        expect($person->addresses)->toContain($addresses);
    });

    it('morph many email_addresses', function (): void {
        $person = Person::factory()->create();
        $email_addresses = EmailAddress::factory()->count(5)->for($person, 'owner')->create();

        expect($person->emailAddresses)->toContainOnlyInstancesOf(EmailAddress::class);
        expect($person->emailAddresses)->toHaveCount(5);
        expect($person->emailAddresses)->toContain($email_addresses);
    });

    it('morph many phone_numbers', function (): void {
        $person = Person::factory()->create();
        $phone_numbers = PhoneNumber::factory()->count(5)->for($person, 'owner')->create();

        expect($person->phoneNumbers)->toContainOnlyInstancesOf(PhoneNumber::class);
        expect($person->phoneNumbers)->toHaveCount(5);
        expect($person->phoneNumbers)->toContain($phone_numbers);
    });

    it('morph many social_network_profile', function (): void {
        $person = Person::factory()->create();
        $social_network_profiles = SocialNetworkProfile::factory()->count(5)->for($person, 'owner')->create();

        expect($person->socialNetworkProfiles)->toContainOnlyInstancesOf(SocialNetworkProfile::class);
        expect($person->socialNetworkProfiles)->toHaveCount(5);
        expect($person->socialNetworkProfiles)->toContain($social_network_profiles);
    });

    it('morph many website', function (): void {
        $person = Person::factory()->create();
        $websites = Website::factory()->count(5)->for($person, 'owner')->create();

        expect($person->websites)->toContainOnlyInstancesOf(Website::class);
        expect($person->websites)->toHaveCount(5);
        expect($person->websites)->toContain($websites);
    });
});
