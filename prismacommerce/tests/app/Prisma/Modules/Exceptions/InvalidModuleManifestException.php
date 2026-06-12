<?php

namespace App\Prisma\Modules\Exceptions;

use InvalidArgumentException;

class InvalidModuleManifestException extends InvalidArgumentException
{
    public static function missingField(string $modulePath, string $field): self
    {
        return new self("Module manifest at [{$modulePath}] is missing required field [{$field}].");
    }

    public static function invalidJson(string $manifestPath): self
    {
        return new self("Module manifest [{$manifestPath}] contains invalid JSON.");
    }

    public static function invalidSlug(string $modulePath, string $slug): self
    {
        return new self("Module manifest at [{$modulePath}] has invalid slug [{$slug}]. Use lowercase letters, numbers, and hyphens only.");
    }

    /**
     * @param  array<int, string>  $allowedLayers
     */
    public static function invalidLayer(string $modulePath, string $layer, array $allowedLayers): self
    {
        $allowed = implode(', ', $allowedLayers);

        return new self("Module manifest at [{$modulePath}] has invalid layer [{$layer}]. Allowed layers: {$allowed}.");
    }
}
