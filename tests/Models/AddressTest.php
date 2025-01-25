<?php

use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Models\Address;
use Talp1\LaravelRegistry\Tests\Fakes\Enums\FakeEnum;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function (): void {
    test('table name is read from config', function (): void {
        config(['registry.database.table_names.addresses' => 'addresses']);
        recreateAllTables();
        assertDatabaseHasTable('addresses');

        config(['registry.database.table_names.addresses' => 'test_addresses']);
        recreateAllTables();
        assertDatabaseHasTable('test_addresses');
        assertDatabaseMissingTable('addresses');
    });

    test('morph columns are created from config', function (): void {
        config(['registry.database.morph_names.address_owner' => 'address_owner']);
        recreateAllTables();
        assertTableHasColumns(Address::class, 'address_owner_id', 'address_owner_type');

        config(['registry.database.morph_names.address_owner' => 'test']);
        recreateAllTables();
        assertTableHasColumns(Address::class, 'test_id', 'test_type');
    });

    test('expected columns are created', function (): void {
        assertTableHasColumns(Address::class,
            'id',
            'address_owner_id',
            'address_owner_type',
            'title',
            'street',
            'civic_number',
            'postal_code',
            'city',
            'country',
            'notes',
            'created_at',
            'updated_at',
        );
    });

    test('required columns', function (string $column): void {
        assertColumnIsRequired(Address::class, $column);
    })->with(['address_owner_id', 'address_owner_type', 'street', 'civic_number', 'postal_code', 'city', 'country']);

    test('nullable columns', function (string $column): void {
        assertColumnIsNullable(Address::class, $column);
    })->with(['title', 'notes']);

    test('unique indexes', function (): void {
        config(['registry.database.morph_names.address_owner' => 'address_owner']);
        assertIndexIsUnique(Address::class, ['street', 'civic_number', 'postal_code', 'city', 'country', 'address_owner_id', 'address_owner_type']);
    });
});

describe('read and write db', function (): void {
    it('can create an address', function (): void {
        $address = Address::factory()->create();

        assertDatabaseHas(Address::class, [
            'id' => $address->id,
        ]);
    });

    it('can update an address', function (): void {
        $address = Address::factory()->create();
        $address->update(['city' => 'New City']);

        assertDatabaseHas(Address::class, [
            'id' => $address->id,
            'city' => 'New City',
        ]);
    });

    it('can delete an address', function (): void {
        $address = Address::factory()->create();
        $addressId = $address->id;
        $address->delete();

        assertDatabaseMissing(Address::class, [
            'id' => $addressId,
        ]);
    });

    it('can retrieve an address', function (): void {
        $address = Address::factory()->create();

        $foundAddress = Address::find($address->id);

        expect($foundAddress)->not->toBeNull();
        expect($foundAddress->id)->toBe($address->id);
    });

    it('can list all addresses', function (): void {
        Address::factory()->count(5)->create();

        $addresses = Address::all();

        expect($addresses)->toHaveCount(5);
    });
});

describe('constructor', function (): void {
    it('add morphs attributes from config to fillable', function (): void {
        config([
            'registry.database.morph_names.address_owner' => 'test',
        ]);

        $address = new Address;

        $expected_fillable = [
            'title',
            'street',
            'civic_number',
            'postal_code',
            'city',
            'country',
            'notes',
            'test_id',
            'test_type',
        ];

        expect($address->getFillable())->toBe($expected_fillable);
    });

    describe('table name', function (): void {
        it('binds model table from config', function (): void {
            config([
                'registry.database.table_names.addresses' => 'test',
            ]);

            expect(getTableNameForModel(Address::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function (): void {
            config([
                'registry.database.table_names.addresses' => null,
            ]);

            expect(getTableNameForModel(Address::class))->toBe('addresses');
        });
    });
});

describe('casts', function (): void {
    it('casts country attribute as enum specified in config', function (): void {
        config(['registry.enums.countries' => Countries::class]);
        $address = Address::factory()->create(['country' => Countries::ITALY]);
        expect($address->country)->toBe(Countries::ITALY);

        config(['registry.enums.countries' => FakeEnum::class]);
        $address = Address::factory()->create(['country' => FakeEnum::FAKE]);
        expect($address->country)->toBe(FakeEnum::FAKE);
    });
});

describe('accessors and mutators', function (): void {
    describe('formatted', function (): void {
        it('correctly parses format from config', function (): void {
            config(['registry.address_format' => '{street} {civic_number}, {postal_code} {city} ({country})']);
            $address = Address::factory()->create([
                'street' => 'Via Roma',
                'civic_number' => '1',
                'postal_code' => '00000',
                'city' => 'Roma',
                'country' => Countries::ITALY,
            ]);
            expect($address->formatted)->toBe('Via Roma 1, 00000 Roma (Italy)');

            config(['registry.address_format' => '{street} {civic_number} - {postal_code}, {city} {country}']);
            $address = Address::factory()->create([
                'street' => 'Via Roma',
                'civic_number' => '1',
                'postal_code' => '00000',
                'city' => 'Roma',
                'country' => Countries::ITALY,
            ]);
            expect($address->formatted)->toBe('Via Roma 1 - 00000, Roma Italy');
        });

        it('leaves placeholder untouched if it can not be resolved', function (): void {
            config(['registry.address_format' => '{streetERROR} {civic_number}, {postal_code} {city} ({country})']);

            $address = Address::factory()->create([
                'street' => 'Via Roma',
                'civic_number' => '1',
                'postal_code' => '00000',
                'city' => 'Roma',
                'country' => Countries::ITALY,
            ]);

            expect($address->formatted)->toBe('{streetERROR} 1, 00000 Roma (Italy)');
        });
    });
});

describe('relations', function (): void {
    it('morphs the owner of the address', function (): void {
        $address = Address::factory()->create();

        expect($address->owner)->toBeInstanceOf($address->address_owner_type);
        expect($address->owner->id)->toBe($address->address_owner_id);
    });
});
