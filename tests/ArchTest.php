<?php

declare(strict_types=1);

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'var_dump', 'print_r'])
    ->each->not->toBeUsed();

arch('models are classes')
    ->expect('Talp1\LaravelRegistry\Models')
    ->toBeClasses()
    ->ignoring('Talp1\LaravelRegistry\Models\Traits');

arch('model traits are traits')
    ->expect('Talp1\LaravelRegistry\Models\Traits')
    ->toBeTraits();

arch('enums are enums')
    ->expect('Talp1\LaravelRegistry\Enums')
    ->toBeEnums()
    ->ignoring(['Talp1\LaravelRegistry\Enums\Traits', 'Talp1\LaravelRegistry\Enums\Contracts']);

arch('enums traits are traits')
    ->expect('Talp1\LaravelRegistry\Enums\Traits')
    ->toBeTraits();

arch('enums contracts are interfaces')
    ->expect('Talp1\LaravelRegistry\Enums\Contracts')
    ->toBeInterface();
