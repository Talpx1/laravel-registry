<?php

namespace Talp1\LaravelRegistry;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RegistryServiceProvider extends PackageServiceProvider {
    public function configurePackage(Package $package): void {
        $package
            ->name('laravel-registry')
            ->hasConfigFile()
            ->hasMigration('create_registry_tables');
    }
}
