<?php

namespace Modules\Core\Tests\Unit;

use App\Prisma\Modules\ModuleManifestLoader;
use Tests\TestCase;

class CoreModuleManifestTest extends TestCase
{
    public function test_core_module_manifest_is_valid_for_registry_discovery(): void
    {
        $manifest = app(ModuleManifestLoader::class)->load(
            base_path('modules/Core/module.json'),
            config('prisma-modules.layers'),
        );

        $this->assertSame('Core', $manifest->name);
        $this->assertSame('core', $manifest->slug);
        $this->assertSame('core', $manifest->layer);
        $this->assertTrue($manifest->enabled);
        $this->assertSame([
            'Modules\\Core\\Providers\\CoreServiceProvider',
        ], $manifest->providers);
    }

    public function test_core_module_does_not_add_routes_or_migrations(): void
    {
        $this->assertDirectoryDoesNotExist(base_path('modules/Core/Routes'));
        $this->assertDirectoryDoesNotExist(base_path('modules/Core/Database/Migrations'));
    }
}
