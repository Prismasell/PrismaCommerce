<?php

use App\Prisma\Modules\Data\ModuleManifest;
use App\Prisma\Modules\Exceptions\InvalidModuleManifestException;

it('creates a typed module manifest from valid manifest data', function (): void {
    $manifest = ModuleManifest::fromArray([
        'name' => 'Core',
        'slug' => 'core',
        'version' => '1.0.0',
        'layer' => 'core',
        'enabled' => true,
        'providers' => ['Modules\\Core\\Providers\\CoreServiceProvider'],
        'permissions' => ['core.view'],
        'routes' => ['api' => 'Routes/api.php'],
        'migrations_path' => 'Database/Migrations',
    ], base_path('modules/Core'), ['core', 'commerce']);

    expect($manifest->name)->toBe('Core')
        ->and($manifest->slug)->toBe('core')
        ->and($manifest->enabled)->toBeTrue()
        ->and($manifest->providers)->toBe(['Modules\\Core\\Providers\\CoreServiceProvider'])
        ->and($manifest->routes)->toBe(['api' => 'Routes/api.php']);
});

it('rejects invalid module slugs', function (): void {
    ModuleManifest::fromArray([
        'name' => 'Bad Module',
        'slug' => 'Bad Module',
        'version' => '1.0.0',
        'layer' => 'core',
    ], base_path('modules/BadModule'), ['core']);
})->throws(InvalidModuleManifestException::class);

it('rejects unknown architecture layers', function (): void {
    ModuleManifest::fromArray([
        'name' => 'Unknown Layer',
        'slug' => 'unknown-layer',
        'version' => '1.0.0',
        'layer' => 'sales',
    ], base_path('modules/UnknownLayer'), ['core']);
})->throws(InvalidModuleManifestException::class);
