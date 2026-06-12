<?php

namespace App\Prisma\Modules\Providers;

use App\Prisma\Modules\Contracts\ModuleRegistryContract;
use App\Prisma\Modules\ModuleManifestLoader;
use App\Prisma\Modules\ModuleRegistry;
use Illuminate\Support\ServiceProvider;

class ModuleRegistryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(base_path('config/prisma-modules.php'), 'prisma-modules');

        $this->app->singleton(ModuleManifestLoader::class);
        $this->app->singleton(ModuleRegistryContract::class, ModuleRegistry::class);
        $this->app->alias(ModuleRegistryContract::class, 'prisma.modules');
    }
}
