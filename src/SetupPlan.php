<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Lists the work that finishes an install once its files are in place.
 *
 * Downloading an app rarely leaves it ready to serve; a configuration file still has to be written, for one. The
 * app's plugin answers `speedyspec_app_setup` with the tasks that do it, and the CLI runs them in order. When one
 * fails, the CLI remembers how many finished, so running the same install command again picks up from the failed
 * task. Each task must therefore be safe to run twice.
 *
 * @param list<AppTask> $tasks
 *   The tasks, in the order they run.
 */
final readonly class SetupPlan
{
    public function __construct(
        public array $tasks,
    ) {
    }
}
