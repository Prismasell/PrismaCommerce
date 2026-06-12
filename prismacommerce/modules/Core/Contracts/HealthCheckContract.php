<?php

namespace Modules\Core\Contracts;

use Modules\Core\Data\HealthCheckResult;

interface HealthCheckContract
{
    public function name(): string;

    public function check(): HealthCheckResult;
}
