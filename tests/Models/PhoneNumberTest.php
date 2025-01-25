<?php

declare(strict_types=1);

use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Enums\PhoneLineTypes;
use Talp1\LaravelRegistry\Models\PhoneNumber;
use Talp1\LaravelRegistry\Tests\Fakes\Enums\FakeEnum;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function (): void {
    test('table name is read from config', function (): void {
        config(['registry.database.table_names.phone_numbers' => 'phone_numbers']);
        recreateAllTables();
        assertDatabaseHasTable('phone_numbers');

        config(['registry.database.table_names.phone_numbers' => 'test_phone_numbers']);
        recreateAllTables();
        assertDatabaseHasTable('test_phone_numbers');
        assertDatabaseMissingTable('phone_numbers');
    });

    test('morph columns are created from config', function (): void {
        config(['registry.database.morph_names.phone_number_owner' => 'phone_number_owner']);
        recreateAllTables();
        assertTableHasColumns(PhoneNumber::class, 'phone_number_owner_id', 'phone_number_owner_type');

        config(['registry.database.morph_names.phone_number_owner' => 'test']);
        recreateAllTables();
        assertTableHasColumns(PhoneNumber::class, 'test_id', 'test_type');
    });

    test('expected columns are created', function (): void {
        assertTableHasColumns(PhoneNumber::class,
            'id',
            'phone_number_owner_id',
            'phone_number_owner_type',
            'line_type',
            'title',
            'prefix',
            'phone_number',
            'accepts_sms',
            'accepts_calls',
            'accepts_faxes',
            'is_receive_only',
            'is_operated_by_human',
            'notes',
            'created_at',
            'updated_at',
        );
    });

    test('required columns', function (string $column): void {
        assertColumnIsRequired(PhoneNumber::class, $column);
    })->with(['phone_number_owner_id', 'line_type', 'phone_number_owner_type', 'phone_number', 'accepts_sms', 'accepts_calls', 'accepts_faxes', 'is_receive_only', 'is_operated_by_human']);

    test('nullable columns', function (string $column): void {
        assertColumnIsNullable(PhoneNumber::class, $column);
    })->with(['prefix', 'title', 'notes']);

    test('unique indexes', function (): void {
        config(['registry.database.morph_names.phone_number_owner' => 'phone_number_owner']);

        assertIndexIsUnique(PhoneNumber::class, ['prefix', 'phone_number', 'phone_number_owner_id', 'phone_number_owner_type']);
    });
});

describe('read and write db', function (): void {
    it('can create a phone_number', function (): void {
        $phone_number = PhoneNumber::factory()->create();

        assertDatabaseHas(PhoneNumber::class, [
            'id' => $phone_number->id,
        ]);
    });

    it('can update a phone_number', function (): void {
        $phone_number = PhoneNumber::factory()->create();
        $phone_number->update(['prefix' => Countries::ITALY->phonePrefix()]);

        assertDatabaseHas(PhoneNumber::class, [
            'id' => $phone_number->id,
            'prefix' => Countries::ITALY->phonePrefix(),
        ]);
    });

    it('can delete a phone_number', function (): void {
        $phone_number = PhoneNumber::factory()->create();
        $phone_numberId = $phone_number->id;
        $phone_number->delete();

        assertDatabaseMissing(PhoneNumber::class, [
            'id' => $phone_numberId,
        ]);
    });

    it('can retrieve a phone_number', function (): void {
        $phone_number = PhoneNumber::factory()->create();

        $foundPhoneNumber = PhoneNumber::find($phone_number->id);

        expect($foundPhoneNumber)->not->toBeNull();
        expect($foundPhoneNumber->id)->toBe($phone_number->id);
    });

    it('can list all phone_numbers', function (): void {
        PhoneNumber::factory()->count(5)->create();

        $phone_number = PhoneNumber::all();

        expect($phone_number)->toHaveCount(5);
    });
});

describe('constructor', function (): void {
    it('add morphs attributes from config to fillable', function (): void {
        config([
            'registry.database.morph_names.phone_number_owner' => 'test',
        ]);

        $phone_number = new PhoneNumber;

        $expected_fillable = [
            'line_type',
            'title',
            'prefix',
            'phone_number',
            'accepts_sms',
            'accepts_calls',
            'accepts_faxes',
            'is_receive_only',
            'is_operated_by_human',
            'notes',
            'test_id',
            'test_type',
        ];

        expect($phone_number->getFillable())->toBe($expected_fillable);
    });

    describe('table name', function (): void {
        it('binds model table from config', function (): void {
            config([
                'registry.database.table_names.phone_numbers' => 'test',
            ]);

            expect(getTableNameForModel(PhoneNumber::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function (): void {
            config([
                'registry.database.table_names.phone_numbers' => null,
            ]);

            expect(getTableNameForModel(PhoneNumber::class))->toBe('phone_numbers');
        });
    });
});

describe('casts', function (): void {
    it('casts line_type attribute as enum specified in config', function (): void {
        config(['registry.enums.phone_line_types' => PhoneLineTypes::class]);
        $phone_number = PhoneNumber::factory()->create(['line_type' => PhoneLineTypes::FIXED]);
        expect($phone_number->line_type)->toBe(PhoneLineTypes::FIXED);

        config(['registry.enums.phone_line_types' => FakeEnum::class]);
        $phone_number = PhoneNumber::factory()->create(['line_type' => FakeEnum::FAKE]);
        expect($phone_number->line_type)->toBe(FakeEnum::FAKE);
    });
});

describe('accessors and mutators', function (): void {
    describe('prefixed', function (): void {
        it('is formatted joining plus_sign prefix space phone_number', function (): void {
            $phone_number = PhoneNumber::factory()->create([
                'prefix' => '39',
                'phone_number' => '1234567890',
            ]);
            expect($phone_number->prefixed)->toBe('+39 1234567890');
        });

        it('returns the number as is if prefix is null', function (): void {
            $phone_number = PhoneNumber::factory()->create([
                'prefix' => null,
                'phone_number' => '1234567890',
            ]);

            expect($phone_number->prefixed)->toBe('1234567890');
        });
    });
});

describe('relations', function (): void {
    it('morphs the owner of the phone_number', function (): void {
        $phone_number = PhoneNumber::factory()->create();

        expect($phone_number->owner)->toBeInstanceOf($phone_number->phone_number_owner_type);
        expect($phone_number->owner->id)->toBe($phone_number->phone_number_owner_id);
    });
});
