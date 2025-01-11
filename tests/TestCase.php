<?php

namespace Talp1\LaravelRegistry\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Talp1\LaravelRegistry\LaravelRegistryServiceProvider;

class TestCase extends Orchestra {
    protected function setUp(): void {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Talp1\\LaravelRegistry\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app) {
        return [
            LaravelRegistryServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app) {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
