<?php

namespace Modules\Core\Contracts;

use Modules\Core\Data\DiagnosticResult;

interface DiagnosticsRepositoryContract
{
    public function register(DiagnosticsProbeContract $probe): void;

    /**
     * @return array<int, DiagnosticsProbeContract>
     */
    public function probes(): array;

    /**
     * @return array<string, DiagnosticResult>
     */
    public function inspect(): array;
}
