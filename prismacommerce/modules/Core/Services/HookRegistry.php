<?php

namespace Modules\Core\Services;

use Modules\Core\Contracts\HookRegistryContract;

class HookRegistry implements HookRegistryContract
{
    /**
     * @var array<string, array<int, array{callback: string, priority: int}>>
     */
    private array $hooks = [];

    public function add(string $hook, string $callback, int $priority = 100): void
    {
        $this->hooks[$hook] ??= [];
        $this->hooks[$hook][] = [
            'callback' => $callback,
            'priority' => $priority,
        ];

        usort(
            $this->hooks[$hook],
            fn (array $left, array $right): int => $left['priority'] <=> $right['priority'],
        );
    }

    public function for(string $hook): array
    {
        return $this->hooks[$hook] ?? [];
    }

    public function all(): array
    {
        return $this->hooks;
    }
}
