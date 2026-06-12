<?php

namespace App\Prisma\Modules;

use App\Prisma\Modules\Data\ModuleManifest;
use App\Prisma\Modules\Exceptions\InvalidModuleManifestException;
use Illuminate\Filesystem\Filesystem;

class ModuleManifestLoader
{
    public function __construct(
        private readonly Filesystem $files,
    ) {
    }

    /**
     * @param  array<int, string>  $allowedLayers
     */
    public function load(string $manifestPath, array $allowedLayers): ModuleManifest
    {
        $contents = $this->files->get($manifestPath);
        $data = json_decode($contents, true);

        if (! is_array($data)) {
            throw InvalidModuleManifestException::invalidJson($manifestPath);
        }

        return ModuleManifest::fromArray($data, dirname($manifestPath), $allowedLayers);
    }
}
