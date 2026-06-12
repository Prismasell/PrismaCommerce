<?php

$modulesPath = env('PRISMA_MODULES_PATH');

return [
    /*
    |--------------------------------------------------------------------------
    | Official Module Registry
    |--------------------------------------------------------------------------
    |
    | M1A-03 establishes filesystem manifest discovery only. Later milestones
    | may add admin activation, lifecycle commands, permissions, and health
    | checks without changing this public contract.
    |
    */

    'base_path' => $modulesPath
        ? (str_starts_with($modulesPath, DIRECTORY_SEPARATOR) ? $modulesPath : base_path($modulesPath))
        : base_path('modules'),

    'manifest_filename' => 'module.json',

    'layers' => [
        'core',
        'commerce',
        'cms',
        'integration',
        'extension',
    ],

    'cache' => [
        'enabled' => env('PRISMA_MODULE_CACHE_ENABLED', true),
        'key' => env('PRISMA_MODULE_CACHE_KEY', 'prisma.modules.registry'),
        'ttl' => (int) env('PRISMA_MODULE_CACHE_TTL', 300),
    ],

    'module_structure' => [
        'Config',
        'Database/Migrations',
        'Database/Seeders',
        'Http/Controllers',
        'Http/Requests',
        'Http/Resources',
        'Models',
        'Services',
        'Repositories',
        'Filament/Resources',
        'Filament/Widgets',
        'Routes',
        'Providers',
        'Tests',
        'docs',
    ],
];
