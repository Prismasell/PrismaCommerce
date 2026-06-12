<?php

namespace Modules\Core\Contracts;

interface HookRegistryContract
{
    public function add(string $hook, string $callback, int $priority = 100): void;

    /**
     * @return array<int, array{callback: string, priority: int}>
     */
    public function for(string $hook): array;

    /**
     * @return array<string, array<int, array{callback: string, priority: int}>>
     */
    public function all(): array;
}
