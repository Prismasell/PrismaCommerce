<?php

namespace Modules\Core\Services;

use Modules\Core\Contracts\DiagnosticsProbeContract;
use Modules\Core\Contracts\DiagnosticsRepositoryContract;

class DiagnosticsRepository implements DiagnosticsRepositoryContract
{
    /**
     * @var array<int, DiagnosticsProbeContract>
     */
    private array $probes = [];

    public function register(DiagnosticsProbeContract $probe): void
    {
        $this->probes[] = $probe;
    }

    public function probes(): array
    {
        return $this->probes;
    }

    public function inspect(): array
    {
        return collect($this->probes)
            ->mapWithKeys(fn (DiagnosticsProbeContract $probe): array => [
                $probe->name() => $probe->inspect(),
            ])
            ->all();
    }
}
