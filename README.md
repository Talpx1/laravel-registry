# Laravel Registry

TODO: yet to publish  
[![Latest Version on Packagist](https://img.shields.io/packagist/v/talp1/laravel-registry.svg?style=flat-square)](https://packagist.org/packages/talp1/laravel-registry)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/talp1/laravel-registry/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/talp1/laravel-registry/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/talp1/laravel-registry/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/talp1/laravel-registry/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/talp1/laravel-registry.svg?style=flat-square)](https://packagist.org/packages/talp1/laravel-registry)

Easy registry management for Laravel

No need to create your own registry management anymore!  
Laravel Registry ships with many features to help you profile companies, customers, people with all the necessary data such as email, phone number, socials...

```php
//TODO
Registry::create([
    'type' => RegistryTypes::CUSTOMER
])
```

## Support

[<img src="https://martinaway.com/wp-content/uploads/2023/08/Buy-me-a-coffee.png" />](https://buymeacoffee.com/talp1)

I'm a self-employed solo developer, trying to make cool and hopefully useful pieces of software.  
If you are a company or you used this package in one of your projects, please consider [supporting me](https://buymeacoffee.com/talp1)!  
Thanks <3

## Installation

You can install the package via composer:

```bash
composer require talp1/laravel-registry
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-registry-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-registry-config"
```

This is the contents of the published config file:

```php
return [
    //TODO
];
```

## Usage

```php
//TODO
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Simone Cerruti (Talp1)](https://github.com/Talpx1)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
