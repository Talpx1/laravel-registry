<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

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
    ->withPreparedSets(
        typeDeclarations: true
    );
