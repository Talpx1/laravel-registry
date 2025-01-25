<?php

declare(strict_types=1);

use Talp1\LaravelRegistry\Enums\EmailAddressProviders;
use Talp1\LaravelRegistry\Models\EmailAddress;
use Talp1\LaravelRegistry\Tests\Fakes\Enums\FakeEnum;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function (): void {
    test('table name is read from config', function (): void {
        config(['registry.database.table_names.email_addresses' => 'email_addresses']);
        recreateAllTables();
        assertDatabaseHasTable('email_addresses');

        config(['registry.database.table_names.email_addresses' => 'test_email_addresses']);
        recreateAllTables();
        assertDatabaseHasTable('test_email_addresses');
        assertDatabaseMissingTable('email_addresses');
    });

    test('morph columns are created from config', function (): void {
        config(['registry.database.morph_names.email_address_owner' => 'email_address_owner']);
        recreateAllTables();
        assertTableHasColumns(EmailAddress::class, 'email_address_owner_id', 'email_address_owner_type');

        config(['registry.database.morph_names.email_address_owner' => 'test']);
        recreateAllTables();
        assertTableHasColumns(EmailAddress::class, 'test_id', 'test_type');
    });

    test('expected columns are created', function (): void {
        assertTableHasColumns(EmailAddress::class,
            'id',
            'title',
            'email_address',
            'provider',
            'is_certified',
            'is_no_reply',
            'is_operated_by_human',
            'notes',
            'created_at',
            'updated_at',
        );
    });

    test('required columns', function (string $column): void {
        assertColumnIsRequired(EmailAddress::class, $column);
    })->with(['email_address_owner_id', 'email_address_owner_type', 'email_address', 'is_certified', 'is_no_reply', 'is_operated_by_human']);

    test('nullable columns', function (string $column): void {
        assertColumnIsNullable(EmailAddress::class, $column);
    })->with(['provider', 'title', 'notes']);

    test('unique indexes', function (): void {
        config(['registry.database.morph_names.email_address_owner' => 'email_address_owner']);

        assertIndexIsUnique(EmailAddress::class, ['email_address', 'email_address_owner_id', 'email_address_owner_type']);
    });
});

describe('read and write db', function (): void {
    it('can create a email_address', function (): void {
        $email_address = EmailAddress::factory()->create();

        assertDatabaseHas(EmailAddress::class, [
            'id' => $email_address->id,
        ]);
    });

    it('can update a email_address', function (): void {
        $email_address = EmailAddress::factory()->create();
        $email_address->update(['email_address' => 'test@test.test']);

        assertDatabaseHas(EmailAddress::class, [
            'id' => $email_address->id,
            'email_address' => 'test@test.test',
        ]);
    });

    it('can delete a email_address', function (): void {
        $email_address = EmailAddress::factory()->create();
        $email_addressId = $email_address->id;
        $email_address->delete();

        assertDatabaseMissing(EmailAddress::class, [
            'id' => $email_addressId,
        ]);
    });

    it('can retrieve a email_address', function (): void {
        $email_address = EmailAddress::factory()->create();

        $foundEmailAddress = EmailAddress::find($email_address->id);

        expect($foundEmailAddress)->not->toBeNull();
        expect($foundEmailAddress->id)->toBe($email_address->id);
    });

    it('can list all email_addresses', function (): void {
        EmailAddress::factory()->count(5)->create();

        $email_address = EmailAddress::all();

        expect($email_address)->toHaveCount(5);
    });
});

describe('constructor', function (): void {
    it('add morphs attributes from config to fillable', function (): void {
        config([
            'registry.database.morph_names.email_address_owner' => 'test',
        ]);

        $email_address = new EmailAddress;

        $expected_fillable = [
            'title',
            'email_address',
            'provider',
            'is_certified',
            'is_no_reply',
            'is_operated_by_human',
            'notes',
            'test_id',
            'test_type',
        ];

        expect($email_address->getFillable())->toBe($expected_fillable);
    });

    describe('table name', function (): void {
        it('binds model table from config', function (): void {
            config([
                'registry.database.table_names.email_addresses' => 'test',
            ]);

            expect(getTableNameForModel(EmailAddress::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function (): void {
            config([
                'registry.database.table_names.email_addresses' => null,
            ]);

            expect(getTableNameForModel(EmailAddress::class))->toBe('email_addresses');
        });
    });
});

describe('casts', function (): void {
    it('casts provider attribute as enum specified in config', function (): void {
        config(['registry.enums.email_address_providers' => EmailAddressProviders::class]);
        $email_address = EmailAddress::factory()->create(['provider' => EmailAddressProviders::GMAIL]);
        expect($email_address->provider)->toBe(EmailAddressProviders::GMAIL);

        config(['registry.enums.email_address_providers' => FakeEnum::class]);
        $email_address = EmailAddress::factory()->create(['provider' => FakeEnum::FAKE]);
        expect($email_address->provider)->toBe(FakeEnum::FAKE);
    });
});

describe('relations', function (): void {
    it('morphs the owner of the email_address', function (): void {
        $email_address = EmailAddress::factory()->create();

        expect($email_address->owner)->toBeInstanceOf($email_address->email_address_owner_type);
        expect($email_address->owner->id)->toBe($email_address->email_address_owner_id);
    });
});
