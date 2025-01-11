<?php

namespace Talp1\LaravelRegistry;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Talp1\LaravelRegistry\Commands\LaravelRegistryCommand;

class LaravelRegistryServiceProvider extends PackageServiceProvider {
    public function configurePackage(Package $package): void {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-registry')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_registry_table')
            ->hasCommand(LaravelRegistryCommand::class);
    }
}
