<?php

namespace Modules\Core\Contracts;

interface PermissionRegistryContract
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public function register(string $permission, array $metadata = []): void;

    public function has(string $permission): bool;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function all(): array;
}
