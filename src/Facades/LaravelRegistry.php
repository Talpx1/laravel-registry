<?php

namespace Talp1\LaravelRegistry\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Talp1\LaravelRegistry\LaravelRegistry
 */
class LaravelRegistry extends Facade {
    protected static function getFacadeAccessor(): string {
        return \Talp1\LaravelRegistry\LaravelRegistry::class;
    }
}
