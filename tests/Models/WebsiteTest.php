

<?php

use Talp1\LaravelRegistry\Models\Website;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function () {
    test('table name is read from config', function () {
        config(['registry.database.table_names.websites' => 'websites']);
        recreateAllTables();
        assertDatabaseHasTable('websites');

        config(['registry.database.table_names.websites' => 'test_websites']);
        recreateAllTables();
        assertDatabaseHasTable('test_websites');
        assertDatabaseMissingTable('websites');
    });

    test('morph columns are created from config', function () {
        config(['registry.database.morph_names.website_owner' => 'website_owner']);
        recreateAllTables();
        assertTableHasColumns(Website::class, 'website_owner_id', 'website_owner_type');

        config(['registry.database.morph_names.website_owner' => 'test']);
        recreateAllTables();
        assertTableHasColumns(Website::class, 'test_id', 'test_type');
    });

    test('expected columns are created', function () {
        assertTableHasColumns(Website::class,
            'id',
            'website_owner_id',
            'website_owner_type',
            'title',
            'url',
            'notes',
            'created_at',
            'updated_at',
        );
    });

    test('required columns', function (string $column) {
        assertColumnIsRequired(Website::class, $column);
    })->with(['website_owner_id', 'website_owner_type', 'url']);

    test('nullable columns', function (string $column) {
        assertColumnIsNullable(Website::class, $column);
    })->with(['title', 'notes']);

    test('unique indexes', function () {
        config(['registry.database.morph_names.website_owner' => 'website_owner']);

        assertIndexIsUnique(Website::class, ['url', 'website_owner_id', 'website_owner_type']);
    });
});

describe('read and write db', function () {
    it('can create a website', function () {
        $website = Website::factory()->create();

        assertDatabaseHas(Website::class, [
            'id' => $website->id,
        ]);
    });

    it('can update a website', function () {
        $website = Website::factory()->create();
        $website->update(['url' => 'test.test']);

        assertDatabaseHas(Website::class, [
            'id' => $website->id,
            'url' => 'test.test',
        ]);
    });

    it('can delete a website', function () {
        $website = Website::factory()->create();
        $websiteId = $website->id;
        $website->delete();

        assertDatabaseMissing(Website::class, [
            'id' => $websiteId,
        ]);
    });

    it('can retrieve a website', function () {
        $website = Website::factory()->create();

        $foundWebsite = Website::find($website->id);

        expect($foundWebsite)->not->toBeNull();
        expect($foundWebsite->id)->toBe($website->id);
    });

    it('can list all websites', function () {
        Website::factory()->count(5)->create();

        $website = Website::all();

        expect($website)->toHaveCount(5);
    });
});

describe('constructor', function () {
    it('add morphs attributes from config to fillable', function () {
        config([
            'registry.database.morph_names.website_owner' => 'test',
        ]);

        $website = new Website;

        $expected_fillable = [
            'title',
            'url',
            'notes',
            'test_id',
            'test_type',
        ];

        expect($website->getFillable())->toBe($expected_fillable);
    });

    describe('table name', function () {
        it('binds model table from config', function () {
            config([
                'registry.database.table_names.websites' => 'test',
            ]);

            expect(getTableNameForModel(Website::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function () {
            config([
                'registry.database.table_names.websites' => null,
            ]);

            expect(getTableNameForModel(Website::class))->toBe('websites');
        });
    });
});

describe('relations', function () {
    it('morphs the owner of the website', function () {
        $website = Website::factory()->create();

        expect($website->owner)->toBeInstanceOf($website->website_owner_type);
        expect($website->owner->id)->toBe($website->website_owner_id);
    });
});
