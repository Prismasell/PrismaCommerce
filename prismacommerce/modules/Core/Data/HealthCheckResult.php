<?php

namespace Modules\Core\Data;

final readonly class HealthCheckResult
{
    /**
     * @param  array<string, mixed>  $context
     */
    public function __construct(
        public string $status,
        public string $message,
        public array $context = [],
    ) {
    }

    public static function ok(string $message = 'OK', array $context = []): self
    {
        return new self('ok', $message, $context);
    }

    public static function warning(string $message, array $context = []): self
    {
        return new self('warning', $message, $context);
    }

    public static function failed(string $message, array $context = []): self
    {
        return new self('failed', $message, $context);
    }
}
