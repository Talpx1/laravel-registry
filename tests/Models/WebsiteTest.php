<?php

declare(strict_types=1);

use Talp1\LaravelRegistry\Models\Website;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function (): void {
    test('table name is read from config', function (): void {
        config(['registry.database.table_names.websites' => 'websites']);
        recreateAllTables();
        assertDatabaseHasTable('websites');

        config(['registry.database.table_names.websites' => 'test_websites']);
        recreateAllTables();
        assertDatabaseHasTable('test_websites');
        assertDatabaseMissingTable('websites');
    });

    test('morph columns are created from config', function (): void {
        config(['registry.database.morph_names.website_owner' => 'website_owner']);
        recreateAllTables();
        assertTableHasColumns(Website::class, 'website_owner_id', 'website_owner_type');

        config(['registry.database.morph_names.website_owner' => 'test']);
        recreateAllTables();
        assertTableHasColumns(Website::class, 'test_id', 'test_type');
    });

    test('expected columns are created', function (): void {
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

    test('required columns', function (string $column): void {
        assertColumnIsRequired(Website::class, $column);
    })->with(['website_owner_id', 'website_owner_type', 'url']);

    test('nullable columns', function (string $column): void {
        assertColumnIsNullable(Website::class, $column);
    })->with(['title', 'notes']);

    test('unique indexes', function (): void {
        config(['registry.database.morph_names.website_owner' => 'website_owner']);

        assertIndexIsUnique(Website::class, ['url', 'website_owner_id', 'website_owner_type']);
    });
});

describe('read and write db', function (): void {
    it('can create a website', function (): void {
        $website = Website::factory()->create();

        assertDatabaseHas(Website::class, [
            'id' => $website->id,
        ]);
    });

    it('can update a website', function (): void {
        $website = Website::factory()->create();
        $website->update(['url' => 'test.test']);

        assertDatabaseHas(Website::class, [
            'id' => $website->id,
            'url' => 'test.test',
        ]);
    });

    it('can delete a website', function (): void {
        $website = Website::factory()->create();
        $websiteId = $website->id;
        $website->delete();

        assertDatabaseMissing(Website::class, [
            'id' => $websiteId,
        ]);
    });

    it('can retrieve a website', function (): void {
        $website = Website::factory()->create();

        $foundWebsite = Website::find($website->id);

        expect($foundWebsite)->not->toBeNull();
        expect($foundWebsite->id)->toBe($website->id);
    });

    it('can list all websites', function (): void {
        Website::factory()->count(5)->create();

        $website = Website::all();

        expect($website)->toHaveCount(5);
    });
});

describe('constructor', function (): void {
    it('add morphs attributes from config to fillable', function (): void {
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

    describe('table name', function (): void {
        it('binds model table from config', function (): void {
            config([
                'registry.database.table_names.websites' => 'test',
            ]);

            expect(getTableNameForModel(Website::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function (): void {
            config([
                'registry.database.table_names.websites' => null,
            ]);

            expect(getTableNameForModel(Website::class))->toBe('websites');
        });
    });
});

describe('relations', function (): void {
    it('morphs the owner of the website', function (): void {
        $website = Website::factory()->create();

        expect($website->owner)->toBeInstanceOf($website->website_owner_type);
        expect($website->owner->id)->toBe($website->website_owner_id);
    });
});
