<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/config',
        __DIR__.'/src',
        __DIR__.'/tests',
        __DIR__.'/database',
    ])
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    // ->withTypeCoverageLevel(0)
    // ->withPreparedSets(
    //     deadCode: true,
    //     codeQuality: true,
    //     typeDeclarations: true,
    //     privatization: true,
    //     instanceOf: true,
    //     earlyReturn: true,
    //     strictBooleans: true,
    //     carbon: true,
    //     rectorPreset: true,
    //     phpunitCodeQuality: false,
    //     phpunit: false
    // );
    ->withRules([
        DeclareStrictTypesRector::class,
    ]);
