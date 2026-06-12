<?php

namespace Modules\Core\Services;

use Modules\Core\Contracts\VersionRegistryContract;

class VersionRegistry implements VersionRegistryContract
{
    /**
     * @var array<string, string>
     */
    private array $versions = [
        'core' => '0.1.0',
    ];

    public function register(string $component, string $version): void
    {
        $this->versions[$component] = $version;
    }

    public function get(string $component): ?string
    {
        return $this->versions[$component] ?? null;
    }

    public function all(): array
    {
        return $this->versions;
    }
}
