<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Tells the CLI how to load an app when it runs the app's own code in a separate process.
 *
 * The CLI cannot know an app's entry point, so the app's plugin names it, relative to the install root; tasks that
 * need the app then run inside it, and its activation and setup code really runs. A null entry loads nothing.
 *
 * @param array<string, string> $ini
 *   The php.ini settings for the process.
 * @param array<string, string> $server
 *   The entries set in `$_SERVER` before the entry file loads.
 * @param ?Workload $workload
 *   The workload that serves a Kubernetes install; null on other drivers.
 * @param ?MaintenanceFile $maintenance
 *   The file that puts the app in maintenance while its files are swapped; null for none.
 */
final readonly class AppRuntime
{
    public function __construct(
        public ?string $entry = null,
        public array $ini = [],
        public array $server = [],
        public ?Workload $workload = null,
        public ?MaintenanceFile $maintenance = null,
    ) {
    }
}
