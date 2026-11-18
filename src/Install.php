<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Identifies one installed app, as the CLI hands it to the hooks that maintain it.
 *
 * Commands that act on an install by name pass this to the app's plugin, so one plugin can serve several installs and
 * tell them apart. The root is the install's directory on this machine, and is null where the files are elsewhere,
 * such as in a cluster.
 *
 * @param string[] $parts
 *   The parts that were installed.
 */
final readonly class Install
{
    public function __construct(
        public string $name,
        public string $app,
        public array $parts,
        public string $driver,
        public ?string $root,
    ) {
    }
}
