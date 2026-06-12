<?php

namespace Modules\Core\Services;

use Modules\Core\Contracts\EventRegistryContract;

class EventRegistry implements EventRegistryContract
{
    /**
     * @var array<string, array<int, string>>
     */
    private array $listeners = [];

    public function listen(string $event, string $listener): void
    {
        $this->listeners[$event] ??= [];
        $this->listeners[$event][] = $listener;
    }

    public function listenersFor(string $event): array
    {
        return $this->listeners[$event] ?? [];
    }

    public function all(): array
    {
        return $this->listeners;
    }
}
