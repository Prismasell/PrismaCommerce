<?php

namespace Modules\Core\Contracts;

use Modules\Core\Data\DiagnosticResult;

interface DiagnosticsProbeContract
{
    public function name(): string;

    public function inspect(): DiagnosticResult;
}
