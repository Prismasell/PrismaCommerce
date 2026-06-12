<?php

namespace Modules\Core\Contracts;

use Modules\Core\Data\HealthCheckResult;

interface HealthCheckRegistryContract
{
    public function register(HealthCheckContract $check): void;

    /**
     * @return array<int, HealthCheckContract>
     */
    public function all(): array;

    /**
     * @return array<string, HealthCheckResult>
     */
    public function run(): array;
}
