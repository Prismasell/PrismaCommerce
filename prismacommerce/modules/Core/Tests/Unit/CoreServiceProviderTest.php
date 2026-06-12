<?php

namespace Modules\Core\Tests\Unit;

use Modules\Core\Contracts\DiagnosticsRepositoryContract;
use Modules\Core\Contracts\EventRegistryContract;
use Modules\Core\Contracts\HealthCheckRegistryContract;
use Modules\Core\Contracts\HookRegistryContract;
use Modules\Core\Contracts\PermissionRegistryContract;
use Modules\Core\Contracts\VersionRegistryContract;
use Modules\Core\Providers\CoreServiceProvider;
use Modules\Core\Services\DiagnosticsRepository;
use Modules\Core\Services\EventRegistry;
use Modules\Core\Services\HealthCheckRegistry;
use Modules\Core\Services\HookRegistry;
use Modules\Core\Services\PermissionRegistry;
use Modules\Core\Services\VersionRegistry;
use Tests\TestCase;

class CoreServiceProviderTest extends TestCase
{
    public function test_core_service_provider_binds_foundation_contracts(): void
    {
        $this->app->register(CoreServiceProvider::class);

        $this->assertInstanceOf(VersionRegistry::class, app(VersionRegistryContract::class));
        $this->assertInstanceOf(HealthCheckRegistry::class, app(HealthCheckRegistryContract::class));
        $this->assertInstanceOf(DiagnosticsRepository::class, app(DiagnosticsRepositoryContract::class));
        $this->assertInstanceOf(EventRegistry::class, app(EventRegistryContract::class));
        $this->assertInstanceOf(HookRegistry::class, app(HookRegistryContract::class));
        $this->assertInstanceOf(PermissionRegistry::class, app(PermissionRegistryContract::class));
    }
}
