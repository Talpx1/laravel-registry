<?php

namespace Talp1\LaravelRegistry\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Talp1\LaravelRegistry\LaravelRegistry
 */
class Registry extends Facade {
    protected static function getFacadeAccessor(): string {
        return \Talp1\LaravelRegistry\Registry::class;
    }
}
