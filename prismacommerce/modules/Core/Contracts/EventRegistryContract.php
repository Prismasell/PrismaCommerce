<?php

namespace Modules\Core\Contracts;

interface EventRegistryContract
{
    public function listen(string $event, string $listener): void;

    /**
     * @return array<int, string>
     */
    public function listenersFor(string $event): array;

    /**
     * @return array<string, array<int, string>>
     */
    public function all(): array;
}
