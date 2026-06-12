<?php

namespace Modules\Core\Services;

use Modules\Core\Contracts\HealthCheckContract;
use Modules\Core\Contracts\HealthCheckRegistryContract;
use Modules\Core\Data\HealthCheckResult;

class HealthCheckRegistry implements HealthCheckRegistryContract
{
    /**
     * @var array<int, HealthCheckContract>
     */
    private array $checks = [];

    public function register(HealthCheckContract $check): void
    {
        $this->checks[] = $check;
    }

    public function all(): array
    {
        return $this->checks;
    }

    public function run(): array
    {
        return collect($this->checks)
            ->mapWithKeys(fn (HealthCheckContract $check): array => [
                $check->name() => $check->check(),
            ])
            ->all();
    }
}
