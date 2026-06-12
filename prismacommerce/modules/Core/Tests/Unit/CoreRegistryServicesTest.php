<?php

namespace Modules\Core\Tests\Unit;

use Modules\Core\Contracts\DiagnosticsProbeContract;
use Modules\Core\Contracts\HealthCheckContract;
use Modules\Core\Data\DiagnosticResult;
use Modules\Core\Data\HealthCheckResult;
use Modules\Core\Services\DiagnosticsRepository;
use Modules\Core\Services\EventRegistry;
use Modules\Core\Services\HealthCheckRegistry;
use Modules\Core\Services\HookRegistry;
use Modules\Core\Services\PermissionRegistry;
use Modules\Core\Services\VersionRegistry;
use Tests\TestCase;

class CoreRegistryServicesTest extends TestCase
{
    public function test_version_registry_tracks_component_versions(): void
    {
        $registry = new VersionRegistry();
        $registry->register('api', '1.0.0');

        $this->assertSame('0.1.0', $registry->get('core'));
        $this->assertSame('1.0.0', $registry->get('api'));
        $this->assertSame([
            'core' => '0.1.0',
            'api' => '1.0.0',
        ], $registry->all());
    }

    public function test_health_check_registry_runs_registered_checks(): void
    {
        $registry = new HealthCheckRegistry();
        $registry->register(new class implements HealthCheckContract {
            public function name(): string
            {
                return 'database';
            }

            public function check(): HealthCheckResult
            {
                return HealthCheckResult::ok('Database reachable');
            }
        });

        $results = $registry->run();

        $this->assertArrayHasKey('database', $results);
        $this->assertSame('ok', $results['database']->status);
    }

    public function test_diagnostics_repository_runs_registered_probes(): void
    {
        $repository = new DiagnosticsRepository();
        $repository->register(new class implements DiagnosticsProbeContract {
            public function name(): string
            {
                return 'runtime';
            }

            public function inspect(): DiagnosticResult
            {
                return new DiagnosticResult('runtime', 'ok', ['php' => PHP_VERSION]);
            }
        });

        $results = $repository->inspect();

        $this->assertArrayHasKey('runtime', $results);
        $this->assertSame('ok', $results['runtime']->status);
    }

    public function test_event_and_hook_registries_record_registrations(): void
    {
        $events = new EventRegistry();
        $events->listen('core.booted', 'ListenerClass');

        $hooks = new HookRegistry();
        $hooks->add('core.dashboard', 'HighPriorityCallback', 10);
        $hooks->add('core.dashboard', 'LowPriorityCallback', 100);

        $this->assertSame(['ListenerClass'], $events->listenersFor('core.booted'));
        $this->assertSame('HighPriorityCallback', $hooks->for('core.dashboard')[0]['callback']);
    }

    public function test_permission_registry_is_placeholder_only(): void
    {
        $registry = new PermissionRegistry();
        $registry->register('core.view-diagnostics', ['module' => 'core']);

        $this->assertTrue($registry->has('core.view-diagnostics'));
        $this->assertSame(['module' => 'core'], $registry->all()['core.view-diagnostics']);
    }
}
