<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Contracts\DiagnosticsRepositoryContract;
use Modules\Core\Contracts\EventRegistryContract;
use Modules\Core\Contracts\HealthCheckRegistryContract;
use Modules\Core\Contracts\HookRegistryContract;
use Modules\Core\Contracts\PermissionRegistryContract;
use Modules\Core\Contracts\VersionRegistryContract;
use Modules\Core\Services\DiagnosticsRepository;
use Modules\Core\Services\EventRegistry;
use Modules\Core\Services\HealthCheckRegistry;
use Modules\Core\Services\HookRegistry;
use Modules\Core\Services\PermissionRegistry;
use Modules\Core\Services\VersionRegistry;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VersionRegistryContract::class, VersionRegistry::class);
        $this->app->singleton(HealthCheckRegistryContract::class, HealthCheckRegistry::class);
        $this->app->singleton(DiagnosticsRepositoryContract::class, DiagnosticsRepository::class);
        $this->app->singleton(EventRegistryContract::class, EventRegistry::class);
        $this->app->singleton(HookRegistryContract::class, HookRegistry::class);
        $this->app->singleton(PermissionRegistryContract::class, PermissionRegistry::class);
    }

    public function boot(): void
    {
        //
    }
}
