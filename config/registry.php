<?php

declare(strict_types=1);

return [
    /**
     * It's possible to provide a custom address format.
     * The placeholders are the attributes of the Address model and they must be enclosed in curly braces.
     * The placeholders will be replaced with the actual values when the `formatted` accessor is called.
     */
    'address_format' => '{street} {civic_number}, {postal_code} {city} ({country})',

    // If you want to use custom models, specify them here
    'models' => [
        'address' => \Talp1\LaravelRegistry\Models\Address::class,
        'social_network_profile' => \Talp1\LaravelRegistry\Models\SocialNetworkProfile::class,
        'website' => \Talp1\LaravelRegistry\Models\Website::class,
        'phone_number' => \Talp1\LaravelRegistry\Models\PhoneNumber::class,
        'email_address' => \Talp1\LaravelRegistry\Models\EmailAddress::class,
        'person' => \Talp1\LaravelRegistry\Models\Person::class,
    ],

    // You can personalize the table names and morph column names here
    'database' => [
        'morph_names' => [
            'address_owner' => 'address_owner',
            'social_network_profile_owner' => 'social_network_profile_owner',
            'website_owner' => 'website_owner',
            'phone_number_owner' => 'phone_number_owner',
            'email_address_owner' => 'email_address_owner',
        ],

        'table_names' => [
            'addresses' => 'addresses',
            'social_network_profiles' => 'social_network_profiles',
            'websites' => 'websites',
            'phone_numbers' => 'phone_numbers',
            'email_addresses' => 'email_addresses',
            'people' => 'people',
        ],
    ],

    // This package already provides some enums, but you can use one of your own specifying it here
    'enums' => [
        'countries' => \Talp1\LaravelRegistry\Enums\Countries::class,
        'languages' => \Talp1\LaravelRegistry\Enums\Languages::class,
        'continents' => \Talp1\LaravelRegistry\Enums\Continents::class,
        'currencies' => \Talp1\LaravelRegistry\Enums\Currencies::class,
        'social_networks' => \Talp1\LaravelRegistry\Enums\SocialNetworks::class,
        'phone_line_types' => \Talp1\LaravelRegistry\Enums\PhoneLineTypes::class,
        'email_address_providers' => \Talp1\LaravelRegistry\Enums\EmailAddressProviders::class,
        'site_purposes' => \Talp1\LaravelRegistry\Enums\SitePurposes::class,
        'genders' => \Talp1\LaravelRegistry\Enums\Genders::class,
        'education_levels' => \Talp1\LaravelRegistry\Enums\EducationLevels::class,
        'eye_colors' => \Talp1\LaravelRegistry\Enums\EyeColors::class,
        'hair_colors' => \Talp1\LaravelRegistry\Enums\HairColors::class,
        'skin_tones' => \Talp1\LaravelRegistry\Enums\SkinTones::class,
        'blood_types' => \Talp1\LaravelRegistry\Enums\BloodTypes::class,
        'marital_statuses' => \Talp1\LaravelRegistry\Enums\MaritalStatuses::class,
        'religions' => \Talp1\LaravelRegistry\Enums\Religions::class,
    ],
];
