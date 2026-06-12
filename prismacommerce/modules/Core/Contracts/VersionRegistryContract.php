<?php

namespace Modules\Core\Contracts;

interface VersionRegistryContract
{
    public function register(string $component, string $version): void;

    public function get(string $component): ?string;

    /**
     * @return array<string, string>
     */
    public function all(): array;
}
