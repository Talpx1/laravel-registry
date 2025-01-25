

<?php

use Talp1\LaravelRegistry\Enums\SocialNetworks;
use Talp1\LaravelRegistry\Models\SocialNetworkProfile;
use Talp1\LaravelRegistry\Tests\Fakes\Enums\FakeEnum;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function () {
    test('table name is read from config', function () {
        config(['registry.database.table_names.social_network_profiles' => 'social_network_profiles']);
        recreateAllTables();
        assertDatabaseHasTable('social_network_profiles');

        config(['registry.database.table_names.social_network_profiles' => 'test_social_network_profiles']);
        recreateAllTables();
        assertDatabaseHasTable('test_social_network_profiles');
        assertDatabaseMissingTable('social_network_profiles');
    });

    test('morph columns are created from config', function () {
        config(['registry.database.morph_names.social_network_profile_owner' => 'social_network_profile_owner']);
        recreateAllTables();
        assertTableHasColumns(SocialNetworkProfile::class, 'social_network_profile_owner_id', 'social_network_profile_owner_type');

        config(['registry.database.morph_names.social_network_profile_owner' => 'test']);
        recreateAllTables();
        assertTableHasColumns(SocialNetworkProfile::class, 'test_id', 'test_type');
    });

    test('expected columns are created', function () {
        assertTableHasColumns(SocialNetworkProfile::class,
            'id',
            'social_network_profile_owner_id',
            'social_network_profile_owner_type',
            'title',
            'url',
            'username',
            'notes',
            'created_at',
            'updated_at',
        );
    });

    test('required columns', function (string $column) {
        assertColumnIsRequired(SocialNetworkProfile::class, $column);
    })->with(['social_network_profile_owner_id', 'social_network_profile_owner_type', 'url']);

    test('nullable columns', function (string $column) {
        assertColumnIsNullable(SocialNetworkProfile::class, $column);
    })->with(['title', 'notes', 'username']);

    test('unique indexes', function () {
        config(['registry.database.morph_names.social_network_profile_owner' => 'social_network_profile_owner']);

        assertIndexIsUnique(SocialNetworkProfile::class, ['url', 'social_network_profile_owner_id', 'social_network_profile_owner_type']);
        assertIndexIsUnique(SocialNetworkProfile::class, ['username', 'social_network', 'social_network_profile_owner_id', 'social_network_profile_owner_type']);
    });
});

describe('read and write db', function () {
    it('can create a social_network_profile', function () {
        $social_network_profile = SocialNetworkProfile::factory()->create();

        assertDatabaseHas(SocialNetworkProfile::class, [
            'id' => $social_network_profile->id,
        ]);
    });

    it('can update a social_network_profile', function () {
        $social_network_profile = SocialNetworkProfile::factory()->create();
        $social_network_profile->update(['url' => 'test.test']);

        assertDatabaseHas(SocialNetworkProfile::class, [
            'id' => $social_network_profile->id,
            'url' => 'test.test',
        ]);
    });

    it('can delete a social_network_profile', function () {
        $social_network_profile = SocialNetworkProfile::factory()->create();
        $social_network_profileId = $social_network_profile->id;
        $social_network_profile->delete();

        assertDatabaseMissing(SocialNetworkProfile::class, [
            'id' => $social_network_profileId,
        ]);
    });

    it('can retrieve a social_network_profile', function () {
        $social_network_profile = SocialNetworkProfile::factory()->create();

        $foundSocialNetworkProfile = SocialNetworkProfile::find($social_network_profile->id);

        expect($foundSocialNetworkProfile)->not->toBeNull();
        expect($foundSocialNetworkProfile->id)->toBe($social_network_profile->id);
    });

    it('can list all social_network_profiles', function () {
        SocialNetworkProfile::factory()->count(5)->create();

        $social_network_profile = SocialNetworkProfile::all();

        expect($social_network_profile)->toHaveCount(5);
    });
});

describe('constructor', function () {
    it('add morphs attributes from config to fillable', function () {
        config([
            'registry.database.morph_names.social_network_profile_owner' => 'test',
        ]);

        $social_network_profile = new SocialNetworkProfile;

        $expected_fillable = [
            'social_network',
            'title',
            'url',
            'username',
            'notes',
            'test_id',
            'test_type',
        ];

        expect($social_network_profile->getFillable())->toBe($expected_fillable);
    });

    describe('table name', function () {
        it('binds model table from config', function () {
            config([
                'registry.database.table_names.social_network_profiles' => 'test',
            ]);

            expect(getTableNameForModel(SocialNetworkProfile::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function () {
            config([
                'registry.database.table_names.social_network_profiles' => null,
            ]);

            expect(getTableNameForModel(SocialNetworkProfile::class))->toBe('social_network_profiles');
        });
    });
});

describe('casts', function () {
    it('casts social_network attribute as enum specified in config', function () {
        config(['registry.enums.social_networks' => SocialNetworks::class]);
        $social_network_profile = SocialNetworkProfile::factory()->create(['social_network' => SocialNetworks::DISCORD]);
        expect($social_network_profile->social_network)->toBe(SocialNetworks::DISCORD);

        config(['registry.enums.social_networks' => FakeEnum::class]);
        $social_network_profile = SocialNetworkProfile::factory()->create(['social_network' => FakeEnum::FAKE]);
        expect($social_network_profile->social_network)->toBe(FakeEnum::FAKE);
    });
});

describe('accessors and mutators', function () {
    describe('handle', function () {
        it('it concatenates the handle prefix from social network enum and the username', function () {
            $social_network_profile = SocialNetworkProfile::factory()->create([
                'username' => 'test',
                'social_network' => SocialNetworks::INSTAGRAM,
            ]);
            expect($social_network_profile->handle)->toBe('@test');
        });

        it('it works for social networks with null handle prefix', function () {
            expect(SocialNetworks::LINKEDIN->handlePrefix())->toBeNull();

            $social_network_profile = SocialNetworkProfile::factory()->create([
                'username' => 'test',
                'social_network' => SocialNetworks::LINKEDIN,
            ]);
            expect($social_network_profile->handle)->toBe('test');
        });
    });
});

describe('relations', function () {
    it('morphs the owner of the social_network_profile', function () {
        $social_network_profile = SocialNetworkProfile::factory()->create();

        expect($social_network_profile->owner)->toBeInstanceOf($social_network_profile->social_network_profile_owner_type);
        expect($social_network_profile->owner->id)->toBe($social_network_profile->social_network_profile_owner_id);
    });
});
