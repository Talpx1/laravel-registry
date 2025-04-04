<?php

declare(strict_types=1);

use Talp1\LaravelRegistry\Enums\SocialNetworks;
use Talp1\LaravelRegistry\Models\SocialNetworkProfile;
use Talp1\LaravelRegistry\Tests\Fakes\Enums\FakeEnum;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('database constraints', function (): void {
    test('table name is read from config', function (): void {
        config(['registry.database.table_names.social_network_profiles' => 'social_network_profiles']);
        recreateAllTables();
        assertDatabaseHasTable('social_network_profiles');

        config(['registry.database.table_names.social_network_profiles' => 'test_social_network_profiles']);
        recreateAllTables();
        assertDatabaseHasTable('test_social_network_profiles');
        assertDatabaseMissingTable('social_network_profiles');
    });

    test('morph columns are created from config', function (): void {
        config(['registry.database.morph_names.social_network_profile_owner' => 'social_network_profile_owner']);
        recreateAllTables();
        assertTableHasColumns(SocialNetworkProfile::class, 'social_network_profile_owner_id', 'social_network_profile_owner_type');

        config(['registry.database.morph_names.social_network_profile_owner' => 'test']);
        recreateAllTables();
        assertTableHasColumns(SocialNetworkProfile::class, 'test_id', 'test_type');
    });

    test('expected columns are created', function (): void {
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

    test('required columns', function (string $column): void {
        assertColumnIsRequired(SocialNetworkProfile::class, $column);
    })->with(['social_network_profile_owner_id', 'social_network_profile_owner_type', 'url']);

    test('nullable columns', function (string $column): void {
        assertColumnIsNullable(SocialNetworkProfile::class, $column);
    })->with(['title', 'notes', 'username']);

    test('unique indexes', function (): void {
        config(['registry.database.morph_names.social_network_profile_owner' => 'social_network_profile_owner']);

        assertIndexIsUnique(SocialNetworkProfile::class, ['url', 'social_network_profile_owner_id', 'social_network_profile_owner_type']);
        assertIndexIsUnique(SocialNetworkProfile::class, ['username', 'social_network', 'social_network_profile_owner_id', 'social_network_profile_owner_type']);
    });
});

describe('read and write db', function (): void {
    it('can create a social_network_profile', function (): void {
        $social_network_profile = SocialNetworkProfile::factory()->create();

        assertDatabaseHas(SocialNetworkProfile::class, [
            'id' => $social_network_profile->id,
        ]);
    });

    it('can update a social_network_profile', function (): void {
        $social_network_profile = SocialNetworkProfile::factory()->create();
        $social_network_profile->update(['url' => 'test.test']);

        assertDatabaseHas(SocialNetworkProfile::class, [
            'id' => $social_network_profile->id,
            'url' => 'test.test',
        ]);
    });

    it('can delete a social_network_profile', function (): void {
        $social_network_profile = SocialNetworkProfile::factory()->create();
        $social_network_profileId = $social_network_profile->id;
        $social_network_profile->delete();

        assertDatabaseMissing(SocialNetworkProfile::class, [
            'id' => $social_network_profileId,
        ]);
    });

    it('can retrieve a social_network_profile', function (): void {
        $social_network_profile = SocialNetworkProfile::factory()->create();

        $foundSocialNetworkProfile = SocialNetworkProfile::find($social_network_profile->id);

        expect($foundSocialNetworkProfile)->not->toBeNull();
        expect($foundSocialNetworkProfile->id)->toBe($social_network_profile->id);
    });

    it('can list all social_network_profiles', function (): void {
        SocialNetworkProfile::factory()->count(5)->create();

        $social_network_profile = SocialNetworkProfile::all();

        expect($social_network_profile)->toHaveCount(5);
    });
});

describe('constructor', function (): void {
    it('adds primary key to guarded', function (): void {
        $social_network = new SocialNetworkProfile;

        $expected_guarded = [
            'created_at',
            'updated_at',
            $social_network->getKeyName(),
        ];

        expect($social_network->getGuarded())->toBe($expected_guarded);
    });

    describe('table name', function (): void {
        it('binds model table from config', function (): void {
            config([
                'registry.database.table_names.social_network_profiles' => 'test',
            ]);

            expect(getTableNameForModel(SocialNetworkProfile::class))->toBe('test');
        });

        it('delegates table name guessing if config has no table name', function (): void {
            config([
                'registry.database.table_names.social_network_profiles' => null,
            ]);

            expect(getTableNameForModel(SocialNetworkProfile::class))->toBe('social_network_profiles');
        });
    });
});

describe('casts', function (): void {
    it('casts social_network attribute as enum specified in config', function (): void {
        config(['registry.enums.social_networks' => SocialNetworks::class]);
        $social_network_profile = SocialNetworkProfile::factory()->create(['social_network' => SocialNetworks::DISCORD]);
        expect($social_network_profile->social_network)->toBe(SocialNetworks::DISCORD);

        config(['registry.enums.social_networks' => FakeEnum::class]);
        $social_network_profile = SocialNetworkProfile::factory()->create(['social_network' => FakeEnum::FAKE]);
        expect($social_network_profile->social_network)->toBe(FakeEnum::FAKE);
    });
});

describe('accessors and mutators', function (): void {
    describe('handle', function (): void {
        it('it concatenates the handle prefix from social network enum and the username', function (): void {
            $social_network_profile = SocialNetworkProfile::factory()->create([
                'username' => 'test',
                'social_network' => SocialNetworks::INSTAGRAM,
            ]);
            expect($social_network_profile->handle)->toBe('@test');
        });

        it('it works for social networks with null handle prefix', function (): void {
            expect(SocialNetworks::LINKEDIN->handlePrefix())->toBeNull();

            $social_network_profile = SocialNetworkProfile::factory()->create([
                'username' => 'test',
                'social_network' => SocialNetworks::LINKEDIN,
            ]);
            expect($social_network_profile->handle)->toBe('test');
        });
    });
});

describe('relations', function (): void {
    it('morphs the owner of the social_network_profile', function (): void {
        $social_network_profile = SocialNetworkProfile::factory()->create();

        expect($social_network_profile->owner)->toBeInstanceOf($social_network_profile->social_network_profile_owner_type);
        expect($social_network_profile->owner->id)->toBe($social_network_profile->social_network_profile_owner_id);
    });
});
