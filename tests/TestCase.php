<?php

namespace Talp1\LaravelRegistry\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;
use Talp1\LaravelRegistry\RegistryServiceProvider;

class TestCase extends Orchestra {
    protected function setUp(): void {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName): string => 'Talp1\\LaravelRegistry\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app) {
        return [
            RegistryServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $schema = $app['db']->connection()->getSchemaBuilder();

        $schema->create('fake_users', function (Blueprint $table): void {
            $table->increments('id');
        });

        runMigrations();
    }
}
