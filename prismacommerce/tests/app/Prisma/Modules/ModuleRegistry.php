<?php

namespace App\Prisma\Modules;

use App\Prisma\Modules\Contracts\ModuleRegistryContract;
use App\Prisma\Modules\Data\ModuleManifest;
use App\Prisma\Modules\Exceptions\InvalidModuleManifestException;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class ModuleRegistry implements ModuleRegistryContract
{
    public function __construct(
        private readonly Filesystem $files,
        private readonly CacheRepository $cache,
        private readonly ModuleManifestLoader $loader,
    ) {
    }

    /**
     * @return Collection<int, ModuleManifest>
     */
    public function all(): Collection
    {
        $cacheKey = config('prisma-modules.cache.key');
        $ttl = (int) config('prisma-modules.cache.ttl', 300);

        if (! (bool) config('prisma-modules.cache.enabled', true)) {
            return $this->discover();
        }

        return $this->cache->remember($cacheKey, $ttl, fn (): Collection => $this->discover());
    }

    public function find(string $slug): ?ModuleManifest
    {
        return $this->all()->first(fn (ModuleManifest $manifest): bool => $manifest->slug === $slug);
    }

    public function has(string $slug): bool
    {
        return $this->find($slug) !== null;
    }

    public function refresh(): void
    {
        $this->cache->forget(config('prisma-modules.cache.key'));
    }

    /**
     * @return Collection<int, ModuleManifest>
     */
    private function discover(): Collection
    {
        $basePath = config('prisma-modules.base_path', base_path('modules'));
        $manifestFilename = config('prisma-modules.manifest_filename', 'module.json');
        $allowedLayers = config('prisma-modules.layers', []);

        if (! $this->files->isDirectory($basePath)) {
            return collect();
        }

        return collect($this->files->directories($basePath))
            ->map(fn (string $modulePath): string => $modulePath.DIRECTORY_SEPARATOR.$manifestFilename)
            ->filter(fn (string $manifestPath): bool => $this->files->exists($manifestPath))
            ->map(fn (string $manifestPath): ?ModuleManifest => $this->loadManifestForDiscovery($manifestPath, $allowedLayers))
            ->filter()
            ->filter(fn (ModuleManifest $manifest): bool => $manifest->enabled)
            ->sortBy('slug')
            ->values();
    }

    /**
     * @param  array<int, string>  $allowedLayers
     */
    private function loadManifestForDiscovery(string $manifestPath, array $allowedLayers): ?ModuleManifest
    {
        try {
            return $this->loader->load($manifestPath, $allowedLayers);
        } catch (InvalidModuleManifestException) {
            return null;
        }
    }
}
