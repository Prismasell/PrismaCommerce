<?php

namespace App\Prisma\Modules\Contracts;

use App\Prisma\Modules\Data\ModuleManifest;
use Illuminate\Support\Collection;

interface ModuleRegistryContract
{
    /**
     * @return Collection<int, ModuleManifest>
     */
    public function all(): Collection;

    public function find(string $slug): ?ModuleManifest;

    public function has(string $slug): bool;

    public function refresh(): void;
}
