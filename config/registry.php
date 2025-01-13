<?php

return [
    'defaults' => [
        'phone_number_prefix' => '1', // this must be a string not prefixed with '+'
    ],

    // If you want to use custom models, specify them here
    'models' => [

    ],

    // You can personalize the table names here
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
        ],
    ],

    // This package already provides some enums, but you can use one of your own specifying it here
    'enums' => [
        'countries' => \Talp1\LaravelRegistry\Enums\Countries::class,
        'languages' => \Talp1\LaravelRegistry\Enums\Languages::class,
        'continents' => \Talp1\LaravelRegistry\Enums\Continents::class,
        'currencies' => \Talp1\LaravelRegistry\Enums\Currencies::class,
    ],
];
