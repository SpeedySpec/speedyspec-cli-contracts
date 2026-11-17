<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Describes a Kubernetes condition the CLI must see before it treats an install as finished.
 *
 * The CLI polls the named resource until the condition holds, so a plugin can order its steps after workloads
 * are actually ready rather than merely applied.
 */
final readonly class WaitFor
{
    public function __construct(
        public string $kind,
        public string $name,
        public ?string $namespace = null,
        public ?string $condition = null,
    ) {
    }
}
