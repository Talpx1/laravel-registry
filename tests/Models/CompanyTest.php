<?php

declare(strict_types=1);

use Talp1\LaravelRegistry\Enums\CompanyLegalForms;
use Talp1\LaravelRegistry\Enums\CompanyTypes;
use Talp1\LaravelRegistry\Enums\Currencies;
use Talp1\LaravelRegistry\Enums\EconomicSectors;
use Talp1\LaravelRegistry\Models\Address;
use Talp1\LaravelRegistry\Models\Company;
use Talp1\LaravelRegistry\Models\EmailAddress;
use Talp1\LaravelRegistry\Models\PhoneNumber;
use Talp1\LaravelRegistry\Models\SocialNetworkProfile;
use Talp1\LaravelRegistry\Models\Website;
use Talp1\LaravelRegistry\Tests\Fakes\Enums\FakeEnum;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function (): void {
    test('table name is read from config', function (): void {
        config(['registry.database.table_names.companies' => 'companies']);
        recreateAllTables();
        assertDatabaseHasTable('companies');

        config(['registry.database.table_names.companies' => 'test_companies']);
        recreateAllTables();
        assertDatabaseHasTable('test_companies');
        assertDatabaseMissingTable('companies');
    });

    test('expected columns are created', function (): void {
        assertTableHasColumns(Company::class,
            'id',
            'name',
            'vat_code',
            'company_type',
            'parent_company_id',
            'legal_form',
            'economic_sector',
            'share_capital_amount',
            'share_capital_currency',
            'foundation_date',
            'foundation_country',
            'notes',
            'created_at',
            'updated_at',
        );
    });

    test('required columns', function (string $column): void {
        assertColumnIsRequired(Company::class, $column);
    })->with(['id', 'name', 'vat_code']);

    test('nullable columns', function (string $column): void {
        assertColumnIsNullable(Company::class, $column);
    })->with([
        'company_type',
        'parent_company_id',
        'legal_form',
        'economic_sector',
        'share_capital_amount',
        'share_capital_currency',
        'foundation_date',
        'foundation_country',
        'notes',
        'created_at',
        'updated_at',
    ]);
});

describe('read and write db', function (): void {
    it('can create a company', function (): void {
        $company = Company::factory()->create();

        assertDatabaseHas(Company::class, [
            'id' => $company->id,
        ]);
    });

    it('can update a company', function (): void {
        $company = Company::factory()->create();
        $company->update(['name' => 'Test']);

        assertDatabaseHas(Company::class, [
            'id' => $company->id,
            'name' => 'Test',
        ]);
    });

    it('can delete a company', function (): void {
        $company = Company::factory()->create();
        $company_id = $company->id;
        $company->delete();

        assertDatabaseMissing(Company::class, [
            'id' => $company_id,
        ]);
    });

    it('can retrieve a company', function (): void {
        $company = Company::factory()->create();

        $found_company = Company::find($company->id);

        expect($found_company)->not->toBeNull();
        expect($found_company->id)->toBe($company->id);
    });

    it('can list all companies', function (): void {
        Company::factory()->count(5)->create();

        $company = Company::all();

        expect($company)->toHaveCount(5);
    });
});

describe('constructor', function (): void {
    it('adds primary key to guarded', function (): void {
        $company = new Company;

        $expected_guarded = [
            'created_at',
            'updated_at',
            $company->getKeyName(),
        ];

        expect($company->getGuarded())->toBe($expected_guarded);
    });

    describe('table name', function (): void {
        it('binds model table from config', function (): void {
            config([
                'registry.database.table_names.companies' => 'test',
            ]);

            expect(getTableNameForModel(Company::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function (): void {
            config([
                'registry.database.table_names.companies' => null,
            ]);

            expect(getTableNameForModel(Company::class))->toBe('companies');
        });
    });
});

describe('casts', function (): void {
    it('casts company_type attribute as enum specified in config', function (): void {
        config(['registry.enums.company_types' => CompanyTypes::class]);
        $company = Company::factory()->create(['company_type' => CompanyTypes::BUSINESS_GROUP]);
        expect($company->company_type)->toBe(CompanyTypes::BUSINESS_GROUP);

        config(['registry.enums.company_types' => FakeEnum::class]);
        $company = Company::factory()->create(['company_type' => FakeEnum::FAKE]);
        expect($company->company_type)->toBe(FakeEnum::FAKE);
    });

    it('casts legal_form attribute as enum specified in config', function (): void {
        config(['registry.enums.company_legal_forms' => CompanyLegalForms::class]);
        $company = Company::factory()->create(['legal_form' => CompanyLegalForms::LIMITED]);
        expect($company->legal_form)->toBe(CompanyLegalForms::LIMITED);

        config(['registry.enums.company_legal_forms' => FakeEnum::class]);
        $company = Company::factory()->create(['legal_form' => FakeEnum::FAKE]);
        expect($company->legal_form)->toBe(FakeEnum::FAKE);
    });

    it('casts economic_sector attribute as enum specified in config', function (): void {
        config(['registry.enums.economic_sectors' => EconomicSectors::class]);
        $company = Company::factory()->create(['economic_sector' => EconomicSectors::PRIMARY]);
        expect($company->economic_sector)->toBe(EconomicSectors::PRIMARY);

        config(['registry.enums.economic_sectors' => FakeEnum::class]);
        $company = Company::factory()->create(['economic_sector' => FakeEnum::FAKE]);
        expect($company->economic_sector)->toBe(FakeEnum::FAKE);
    });

    it('casts share_capital_currency attribute as enum specified in config', function (): void {
        config(['registry.enums.currencies' => Currencies::class]);
        $company = Company::factory()->create(['share_capital_currency' => Currencies::EURO]);
        expect($company->share_capital_currency)->toBe(Currencies::EURO);

        config(['registry.enums.currencies' => FakeEnum::class]);
        $company = Company::factory()->create(['share_capital_currency' => FakeEnum::FAKE]);
        expect($company->share_capital_currency)->toBe(FakeEnum::FAKE);
    });

    it('casts foundation_date as date', function (): void {
        $company = Company::factory()->create(['foundation_date' => '2001-01-01']);
        expect($company->foundation_date)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
        expect($company->foundation_date->format('Y-m-d'))->toBe('2001-01-01');
    });
});

describe('accessors and mutators', function (): void {
    describe('full company name', function (): void {
        it('joins name and legal form first abbreviation with a space', function (): void {
            $company = Company::factory()->create([
                'name' => 'Name',
                'legal_form' => CompanyLegalForms::LIMITED,
            ]);
            expect($company->full_company_name)->toBe('Name '.CompanyLegalForms::LIMITED->abbreviations()[0]);
        });

        it('discards nulls before joining', function (): void {
            $company = Company::factory()->create([
                'name' => 'Name',
                'legal_form' => null,
            ]);

            expect($company->full_company_name)->toBe('Name');
        });
    });

    describe('years of activity', function (): void {
        it('returns the amount in year between the foundation date and now', function (): void {
            $company = Company::factory()->create([
                'foundation_date' => now()->subYears(23),
            ]);

            expect($company->years_of_activity)->toBe(23);
        });

        it('returns null if foundation date is null', function (): void {
            $company = Company::factory()->create(['foundation_date' => null]);

            expect($company->years_of_activity)->toBeNull();
        });
    });

    describe('share capital', function (): void {
        it('returns the share_capital_amount followed by the share_capital_currency symbol or abbreviation', function (): void {
            $company = Company::factory()->create([
                'share_capital_amount' => 1000,
                'share_capital_currency' => Currencies::EURO,
            ]);

            expect($company->share_capital)->toBe('1000€');
        });

        it('returns null if share_capital_amount is null', function (): void {
            $company = Company::factory()->create(['share_capital_amount' => null]);

            expect($company->share_capital)->toBeNull();
        });

        it('returns null if share_capital_currency is null', function (): void {
            $company = Company::factory()->create(['share_capital_currency' => null]);

            expect($company->share_capital)->toBeNull();
        });
    });
});

describe('relations', function (): void {
    it('morph many addresses', function (): void {
        $company = Company::factory()->create();
        $addresses = Address::factory()->count(5)->for($company, 'owner')->create();

        expect($company->addresses)->toContainOnlyInstancesOf(Address::class);
        expect($company->addresses)->toHaveCount(5);
        expect($company->addresses)->toContain($addresses);
    });

    it('morph many email_addresses', function (): void {
        $company = Company::factory()->create();
        $email_addresses = EmailAddress::factory()->count(5)->for($company, 'owner')->create();

        expect($company->emailAddresses)->toContainOnlyInstancesOf(EmailAddress::class);
        expect($company->emailAddresses)->toHaveCount(5);
        expect($company->emailAddresses)->toContain($email_addresses);
    });

    it('morph many phone_numbers', function (): void {
        $company = Company::factory()->create();
        $phone_numbers = PhoneNumber::factory()->count(5)->for($company, 'owner')->create();

        expect($company->phoneNumbers)->toContainOnlyInstancesOf(PhoneNumber::class);
        expect($company->phoneNumbers)->toHaveCount(5);
        expect($company->phoneNumbers)->toContain($phone_numbers);
    });

    it('morph many social_network_profile', function (): void {
        $company = Company::factory()->create();
        $social_network_profiles = SocialNetworkProfile::factory()->count(5)->for($company, 'owner')->create();

        expect($company->socialNetworkProfiles)->toContainOnlyInstancesOf(SocialNetworkProfile::class);
        expect($company->socialNetworkProfiles)->toHaveCount(5);
        expect($company->socialNetworkProfiles)->toContain($social_network_profiles);
    });

    it('morph many website', function (): void {
        $company = Company::factory()->create();
        $websites = Website::factory()->count(5)->for($company, 'owner')->create();

        expect($company->websites)->toContainOnlyInstancesOf(Website::class);
        expect($company->websites)->toHaveCount(5);
        expect($company->websites)->toContain($websites);
    });

    describe('parent', function () {
        it('may belong to no parent company', function (): void {
            $company = Company::factory()->create();

            expect($company->parent)->toBeNull();
        });

        it('belongs to parent company', function (): void {
            $parent = Company::factory()->create();
            $company = Company::factory()->for($parent, 'parent')->create();

            expect($company->parent)->toBe($parent);
        });
    });
});
