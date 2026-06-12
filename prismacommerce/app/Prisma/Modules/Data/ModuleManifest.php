<?php

namespace App\Prisma\Modules\Data;

use App\Prisma\Modules\Exceptions\InvalidModuleManifestException;

final readonly class ModuleManifest
{
    /**
     * @param  array<int, string>  $providers
     * @param  array<int, string>  $dependencies
     * @param  array<int, string>  $permissions
     * @param  array<string, string>  $routes
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $name,
        public string $slug,
        public string $version,
        public string $layer,
        public bool $enabled,
        public string $path,
        public ?string $description = null,
        public array $providers = [],
        public array $dependencies = [],
        public array $permissions = [],
        public array $routes = [],
        public ?string $migrationsPath = null,
        public array $extra = [],
    ) {
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<int, string>  $allowedLayers
     */
    public static function fromArray(array $data, string $modulePath, array $allowedLayers): self
    {
        foreach (['name', 'slug', 'version', 'layer'] as $field) {
            if (! isset($data[$field]) || ! is_string($data[$field]) || trim($data[$field]) === '') {
                throw InvalidModuleManifestException::missingField($modulePath, $field);
            }
        }

        if (! preg_match('/^[a-z0-9][a-z0-9-]*$/', $data['slug'])) {
            throw InvalidModuleManifestException::invalidSlug($modulePath, $data['slug']);
        }

        if (! in_array($data['layer'], $allowedLayers, true)) {
            throw InvalidModuleManifestException::invalidLayer($modulePath, $data['layer'], $allowedLayers);
        }

        return new self(
            name: $data['name'],
            slug: $data['slug'],
            version: $data['version'],
            layer: $data['layer'],
            enabled: (bool) ($data['enabled'] ?? true),
            path: $modulePath,
            description: isset($data['description']) && is_string($data['description']) ? $data['description'] : null,
            providers: self::stringList($data['providers'] ?? []),
            dependencies: self::stringList($data['dependencies'] ?? []),
            permissions: self::stringList($data['permissions'] ?? []),
            routes: self::stringMap($data['routes'] ?? []),
            migrationsPath: isset($data['migrations_path']) && is_string($data['migrations_path']) ? $data['migrations_path'] : null,
            extra: array_diff_key($data, array_flip([
                'name',
                'slug',
                'version',
                'layer',
                'enabled',
                'description',
                'providers',
                'dependencies',
                'permissions',
                'routes',
                'migrations_path',
            ])),
        );
    }

    /**
     * @param  mixed  $value
     * @return array<int, string>
     */
    private static function stringList(mixed $value): array
    {
        if (! is_array($value)) {
            return [];
        }

        return array_values(array_filter($value, is_string(...)));
    }

    /**
     * @param  mixed  $value
     * @return array<string, string>
     */
    private static function stringMap(mixed $value): array
    {
        if (! is_array($value)) {
            return [];
        }

        return array_filter($value, is_string(...));
    }
}
