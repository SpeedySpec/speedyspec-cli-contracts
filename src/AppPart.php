<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Describes one installable part of an app, such as an admin UI or a worker.
 *
 * The CLI offers each part to the user at install time and preselects the ones flagged as default, so a plugin can
 * let an app be assembled from optional pieces.
 */
final readonly class AppPart
{
    public function __construct(
        public string $id,
        public string $label,
        public bool $default = true,
    ) {
    }
}
