<?php

namespace Modules\Core\Services;

use Modules\Core\Contracts\PermissionRegistryContract;

class PermissionRegistry implements PermissionRegistryContract
{
    /**
     * @var array<string, array<string, mixed>>
     */
    private array $permissions = [];

    public function register(string $permission, array $metadata = []): void
    {
        $this->permissions[$permission] = $metadata;
    }

    public function has(string $permission): bool
    {
        return array_key_exists($permission, $this->permissions);
    }

    public function all(): array
    {
        return $this->permissions;
    }
}
