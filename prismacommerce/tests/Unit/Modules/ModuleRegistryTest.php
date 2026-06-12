<?php

use App\Prisma\Modules\Contracts\ModuleRegistryContract;
use App\Prisma\Modules\Exceptions\InvalidModuleManifestException;
use App\Prisma\Modules\ModuleManifestLoader;

beforeEach(function (): void {
    config()->set('prisma-modules.base_path', base_path('tests/Fixtures/modules'));
    config()->set('prisma-modules.cache.enabled', false);
});

it('discovers enabled module manifests from configured module path', function (): void {
    $registry = app(ModuleRegistryContract::class);

    $modules = $registry->all();

    expect($modules)->toHaveCount(1)
        ->and($modules->first()->slug)->toBe('valid-core-fixture')
        ->and($registry->has('valid-core-fixture'))->toBeTrue()
        ->and($registry->has('disabled-fixture'))->toBeFalse()
        ->and($registry->has('Invalid Fixture'))->toBeFalse();
});

it('finds a module manifest by slug', function (): void {
    $manifest = app(ModuleRegistryContract::class)->find('valid-core-fixture');

    expect($manifest)->not->toBeNull()
        ->and($manifest->name)->toBe('Valid Core Fixture')
        ->and($manifest->layer)->toBe('core')
        ->and($manifest->migrationsPath)->toBe('Database/Migrations');
});

it('returns an empty collection when the modules directory does not exist', function (): void {
    config()->set('prisma-modules.base_path', base_path('tests/Fixtures/missing-modules'));

    expect(app(ModuleRegistryContract::class)->all())->toHaveCount(0);
});

it('skips invalid manifests during registry discovery', function (): void {
    $modules = app(ModuleRegistryContract::class)->all();

    expect($modules->pluck('slug')->all())->toBe(['valid-core-fixture']);
});

it('rejects invalid fixture manifests through the loader', function (): void {
    $loader = app(ModuleManifestLoader::class);

    $loader->load(
        base_path('tests/Fixtures/modules/InvalidModule/module.json'),
        config('prisma-modules.layers'),
    );
})->throws(InvalidModuleManifestException::class);
