<?php

namespace Modules\Core\Data;

final readonly class DiagnosticResult
{
    /**
     * @param  array<string, mixed>  $details
     */
    public function __construct(
        public string $name,
        public string $status,
        public array $details = [],
    ) {
    }
}
