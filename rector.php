<?php

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPhpSets(php83: true)
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    // here we can define, what prepared sets of rules will be applied
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true
    );
