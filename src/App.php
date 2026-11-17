<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Declares an app a plugin makes installable through the CLI.
 *
 * The CLI lists these in its install flow and uses the parts and drivers to decide what to offer and how to deploy
 * it, so a plugin can add apps without the CLI knowing anything about them.
 *
 * @param AppPart[] $parts
 *   The parts the user may choose from.
 * @param string[] $drivers
 *   The names of the drivers able to install the app.
 */
final readonly class App
{
    public function __construct(
        public string $id,
        public string $label,
        public array $parts,
        public array $drivers,
    ) {
    }
}
