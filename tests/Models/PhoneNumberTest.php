

<?php

use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Models\PhoneNumber;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function () {
    test('table name is read from config', function () {
        config(['registry.database.table_names.phone_numbers' => 'phone_numbers']);
        recreateAllTables();
        assertDatabaseHasTable('phone_numbers');

        config(['registry.database.table_names.phone_numbers' => 'test_phone_numbers']);
        recreateAllTables();
        assertDatabaseHasTable('test_phone_numbers');
        assertDatabaseMissingTable('phone_numbers');
    });

    test('morph columns are created from config', function () {
        config(['registry.database.morph_names.phone_number_owner' => 'phone_number_owner']);
        recreateAllTables();
        assertTableHasColumns(PhoneNumber::class, 'phone_number_owner_id', 'phone_number_owner_type');

        config(['registry.database.morph_names.phone_number_owner' => 'test']);
        recreateAllTables();
        assertTableHasColumns(PhoneNumber::class, 'test_id', 'test_type');
    });

    test('expected columns are created', function () {
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

    test('required columns', function (string $column) {
        assertColumnIsRequired(PhoneNumber::class, $column);
    })->with(['phone_number_owner_id', 'line_type', 'phone_number_owner_type', 'phone_number', 'accepts_sms', 'accepts_calls', 'accepts_faxes', 'is_receive_only', 'is_operated_by_human']);

    test('nullable columns', function (string $column) {
        assertColumnIsNullable(PhoneNumber::class, $column);
    })->with(['prefix', 'title', 'notes']);
});

describe('read and write db', function () {
    it('can create a phone_number', function () {
        $phone_number = PhoneNumber::factory()->create();

        assertDatabaseHas(PhoneNumber::class, [
            'id' => $phone_number->id,
        ]);
    });

    it('can update a phone_number', function () {
        $phone_number = PhoneNumber::factory()->create();
        $phone_number->update(['prefix' => Countries::ITALY->phonePrefix()]);

        assertDatabaseHas(PhoneNumber::class, [
            'id' => $phone_number->id,
            'prefix' => Countries::ITALY->phonePrefix(),
        ]);
    });

    it('can delete a phone_number', function () {
        $phone_number = PhoneNumber::factory()->create();
        $phone_numberId = $phone_number->id;
        $phone_number->delete();

        assertDatabaseMissing(PhoneNumber::class, [
            'id' => $phone_numberId,
        ]);
    });

    it('can retrieve a phone_number', function () {
        $phone_number = PhoneNumber::factory()->create();

        $foundPhoneNumber = PhoneNumber::find($phone_number->id);

        expect($foundPhoneNumber)->not->toBeNull();
        expect($foundPhoneNumber->id)->toBe($phone_number->id);
    });

    it('can list all phone_numbers', function () {
        PhoneNumber::factory()->count(5)->create();

        $phone_number = PhoneNumber::all();

        expect($phone_number)->toHaveCount(5);
    });
});

describe('constructor', function () {
    it('add morphs attributes from config to fillable', function () {
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

    describe('table name', function () {
        it('binds model table from config', function () {
            config([
                'registry.database.table_names.phone_numbers' => 'test',
            ]);

            expect(getTableNameForModel(PhoneNumber::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function () {
            config([
                'registry.database.table_names.phone_numbers' => null,
            ]);

            expect(getTableNameForModel(PhoneNumber::class))->toBe('phone_numbers');
        });
    });
});

describe('relations', function () {
    it('morphs the owner of the phone_number', function () {
        $phone_number = PhoneNumber::factory()->create();

        expect($phone_number->owner)->toBeInstanceOf($phone_number->phone_number_owner_type);
        expect($phone_number->owner->id)->toBe($phone_number->phone_number_owner_id);
    });
});
